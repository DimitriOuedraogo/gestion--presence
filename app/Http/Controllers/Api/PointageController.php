<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Presence;
use App\Models\SessionPresence;
use App\Services\DistanceCalcul;
use Illuminate\Http\Request;

class PointageController extends Controller
{
    public function __construct(private DistanceCalcul $distanceCalcul)
    {
    }

    public function store(Request $request)
    {
        // 1. Validation
        $validated = $request->validate([
            'email'               => 'required|email|exists:agents,email',
            'session_presence_id' => 'required|exists:session_presences,id',
            'latitude'            => 'required|numeric|between:-90,90',
            'longitude'           => 'required|numeric|between:-180,180',
            'appareil'            => 'nullable|string|max:45',
        ]);

        // 2. Récupérer l'agent via son email
        $agent = Agent::where('email', $validated['email'])
                      ->where('actif', true)
                      ->firstOrFail();

        // 3. Anti-fraude : un seul pointage par agent par session par jour
        $dejaPointe = Presence::where('agent_id', $agent->id)
            ->where('session_presence_id', $validated['session_presence_id'])
            ->whereDate('date_heure', today())
            ->exists();

        if ($dejaPointe) {
            return response()->json([
                'message' => 'Présence déjà enregistrée pour cette session aujourd\'hui.',
            ], 409);
        }

        // 4. Récupérer la session et son point de présence
        $session = SessionPresence::with('pointPresence')
                                  ->findOrFail($validated['session_presence_id']);
        $point   = $session->pointPresence;

        // 5. Calculer la distance GPS
        $distance = $this->distanceCalcul->calculer(
            $validated['latitude'],
            $validated['longitude'],
            (float) $point->latitude,
            (float) $point->longitude,
        );

        $valide = $this->distanceCalcul->estDansLeRayon($distance, (float) $point->rayon_autorise);

        // 6. Enregistrer la présence
        $presence = Presence::create([
            'date_heure'          => now(),
            'latitude'            => $validated['latitude'],
            'longitude'           => $validated['longitude'],
            'distance_metre'      => $distance,
            'appareil'            => $validated['appareil'] ?? $request->userAgent(),
            'valide'              => $valide,
            'session_presence_id' => $session->id,
            'agent_id'            => $agent->id,
        ]);

        return response()->json([
            'message'        => $valide
                ? 'Présence enregistrée avec succès.'
                : 'Présence enregistrée, mais vous êtes hors de la zone autorisée.',
            'agent'          => [
                'id'     => $agent->id,
                'nom'    => $agent->nom,
                'prenom' => $agent->prenom,
            ],
            'distance_metre' => round($distance, 2),
            'rayon_autorise' => (float) $point->rayon_autorise,
            'valide'         => $valide,
            'presence_id'    => $presence->id,
        ], 201);
    }
}