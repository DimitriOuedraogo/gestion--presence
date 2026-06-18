<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\SessionPresence;
use Illuminate\Http\Request;
use App\Services\GeolocationService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class PresenceController extends Controller
{
    protected $geolocationService;

    public function __construct(GeolocationService $geolocationService)
    {
        $this->geolocationService = $geolocationService;
    }

    public function index()
    {
        // Récupère toutes les sessions pour alimenter la liste déroulante
        $sessions = SessionPresence::orderBy('created_at', 'desc')->get();
        return view('admin.presences.index', compact('sessions'));
    }

    public function getPresencesBySession($sessionId)
    {
        // Récupère les présences associées à la session (Adaptez le nom de la relation ou de la clé étrangère)
        $presences = Presence::with('agent')->where('session_presence_id', $sessionId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'presences' => $presences
        ]);
    }


    public function create(Request $request)
    {
        $sessionId = $request->query('session_id');

        if ($sessionId) {
            // 1. On cherche la session concernée
            $session = SessionPresence::find($sessionId);

            // 2. Si la session n'existe pas ou si l'heure actuelle dépasse l'heure de fin
            if (!$session || Carbon::now()->greaterThan($session->heure_fin)) { // Ajustez 'heure_fin' selon votre colonne
                return redirect()->route('presences.expired');
                // Ou simplement retourner une vue d'erreur :
                // return view('presences.error', ['message' => 'Ce QR Code a expiré.']);
            }
        }

        return view('create', compact('sessionId'));
    }

    public function store(Request $request)
    {
        try {

        
        // Validation
        $validated = $request->validate([
            'email' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
        
        // Query agent
        $agent = \App\Models\Agent::where('email', $validated['email'])->first();
        if (!$agent) {
            return response()->json([
                'success' => false,
                'message' => 'Aucun agent trouvé avec cet email.'
            ], 404);
        }

        // Get IP address from incoming request
        $ipAddress = $request->ip();
        Log::info('Incoming presence request from IP: ' . $ipAddress);
        // Check if IP is in today's connexions history
        $wasConnectedToday = \App\Models\HistoriqueConnexion::where('adresse_ip', $ipAddress)
            ->orWhere('agent_id', $agent->id)
            ->whereBetween('date_tentative', [
                now()->startOfDay(),
                now()->endOfDay()
            ])
            ->where('succes', true)
            ->exists();
        Log::info('IP Address: ' . $ipAddress . ' was connected today: ' . ($wasConnectedToday ? 'Yes' : 'No'));
        if ($wasConnectedToday) {
            $historiqueConnexion = \App\Models\HistoriqueConnexion::create([
                'agent_id' => $agent->id,
                'methode' => 'qr_code',
                'succes' => false,
                'adresse_ip' => $ipAddress,
                'date_tentative' => now(),
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Vous avez déjà validé votre présence aujourd\'hui. Veuillez réessayer à la prochaine session.'
            ], 403);
        }

        $presenceExists = \App\Models\Presence::where('agent_id', $agent->id)
            ->whereDate('date_heure', now()->toDateString())
            ->exists();

        if ($presenceExists) {
            $historiqueConnexion = \App\Models\HistoriqueConnexion::create([
                'agent_id' => $agent->id,
                'methode' => 'qr_code',
                'succes' => false,
                'adresse_ip' => $ipAddress,
                'date_tentative' => now(),
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Vous avez déjà validé votre présence aujourd\'hui. Veuillez réessayer à la prochaine session.'
            ], 403);
        }

        // Query valid session presences
        $currentTime = now()->format('H:i:s');

        $validSessionPresences = \App\Models\SessionPresence::where('heure_debut', '<=', $currentTime)
            ->where('heure_fin', '>=', $currentTime)
            ->where('date_presence', '=', now()->format('Y-m-d'))
            ->get();

        Log::info('Valid Session Presences:', ['sessions' => $validSessionPresences]);
        if ($validSessionPresences->isEmpty()) {
            $historiqueConnexion = \App\Models\HistoriqueConnexion::create([
                'agent_id' => $agent->id,
                'methode' => 'qr_code',
                'succes' => false,
                'adresse_ip' => $ipAddress,
                'date_tentative' => now(),
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Aucune session de présence valide trouvée.'
            ], 404);
        }

        $session = $validSessionPresences->first(); // Assuming you want to use the first valid session presence
        $pointPresence = $session->pointPresence; // Assuming you have a relationship defined in your SessionPresence model
        
        $distance = $this->geolocationService->calculateDistance(
            $validated['latitude'],
            $validated['longitude'],
            $pointPresence->latitude, 
            $pointPresence->longitude
        );
        Log::info('Calculated distance for agent ID: ' . $agent->id . ' is: ' . round($distance, 2) . ' meters.');

        $isWithinAuthorizedRadius = $distance <= $pointPresence->rayon_autorise;

        if (!$isWithinAuthorizedRadius) {
                $historiqueConnexion = \App\Models\HistoriqueConnexion::create([
                    'agent_id' => $agent->id,
                    'methode' => 'qr_code',
                    'succes' => false,
                    'adresse_ip' => $ipAddress,
                    'date_tentative' => now(),
                ]);
            return response()->json([
                'success' => false,
                'message' => 'Vous êtes en dehors du rayon autorisé pour cette session de présence. Distance: ' . round($distance, 2) . ' mètres. Rayon autorisé: ' . $pointPresence->rayon_autorise . ' mètres.'
            ], 400);
        }
        DB::beginTransaction();
        // Create Presence
        $presence = \App\Models\Presence::create(
            [
                'date_heure' => now(),
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'distance_metre' => $distance,
                'appareil' => $request->header('User-Agent'),
                'valide' => true,
                'session_presence_id' => $validSessionPresences->first()->id,
                'agent_id' => $agent->id,
            ]
        );

        // Create HistoriqueConnexion entry
        $historiqueConnexion = \App\Models\HistoriqueConnexion::create([
                'agent_id' => $agent->id,
                'methode' => 'qr_code',
                'succes' => true,
                'adresse_ip' => $ipAddress,
                'date_tentative' => now(),
            ]);
        
        Log::info('Presence stored successfully for agent ID: ' . $agent->id . ' with distance: ' . round($presence->distance_metre, 2) . ' meters.');
        Log::info('HistoriqueConnexion created for agent ID: ' . $historiqueConnexion->agent_id . ' with IP: ' . $historiqueConnexion->adresse_ip);

        DB::commit();
        return response()->json([
            'success' => true,
            'message' => 'Présence enregistrée avec succès.',
            'data' => [
                'email' => $request->email,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]
        ]);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error storing presence', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de l\'enregistrement de la présence.'
            ], 500);
        }
    }

    public function edit($id)
    {
        $presence = \App\Models\Presence::findOrFail($id);
        return view('admin.presences.edit', compact('presence'));
    }
}