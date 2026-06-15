<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        $validated = $request->validate([
            'agent_id'             => 'required|exists:agents,id', // TODO: remplacer par auth()->id() une fois Sanctum en place
            'session_presence_id'  => 'required|exists:session_presences,id',
            'latitude'             => 'required|numeric|between:-90,90',
            'longitude'            => 'required|numeric|between:-180,180',
            'appareil'             => 'nullable|string|max:45',
        ]);

        // Anti-fraude : un seul pointage par agent, par session, par jour
        $dejaPointe = Presence::where('agent_id', $validated['agent_id'])
            ->where('session_presence_id', $validated['session_presence_id'])
            ->whereDate('date_heure', today())
            ->exists();

        if ($dejaPointe) {
            return response()->json([
                'message' => 'Présence déjà enregistrée pour cette session aujourd\'hui.',
            ], 409);
        }

        // Récupérer la session et son point de présence associé
        $session = SessionPresence::with('pointPresence')->findOrFail($validated['session_presence_id']);
        $point   = $session->pointPresence;

        // Calculer la distance entre la position de l'agent et le point autorisé
        $distance = $this->distanceCalcul->calculer(
            $validated['latitude'],
            $validated['longitude'],
            (float) $point->latitude,
            (float) $point->longitude,
        );

        $valide = $this->distanceCalcul->estDansLeRayon($distance, (float) $point->rayon_autorise);

        $presence = Presence::create([
            'date_heure'           => now(),
            'latitude'             => $validated['latitude'],
            'longitude'            => $validated['longitude'],
            'distance_metre'       => $distance,
            'appareil'             => $validated['appareil'] ?? $request->userAgent(),
            'valide'               => $valide,
            'session_presence_id' => $session->id,
            'agent_id'             => $validated['agent_id'],
        ]);

        return response()->json([
            'message'         => $valide
                ? 'Présence enregistrée avec succès.'
                : 'Présence enregistrée, mais hors de la zone autorisée.',
            'distance_metre'  => round($distance, 2),
            'rayon_autorise'  => (float) $point->rayon_autorise,
            'valide'          => $valide,
            'presence'        => $presence,
        ], 201);
    }
}