<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SessionPresence;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class SessionActiveController extends Controller
{
    public function index()
    {
        $maintenant = Carbon::now();

        $session = SessionPresence::with('pointPresence')
            ->whereDate('date_presence', today())
            ->where('heure_debut', '<=', $maintenant->format('H:i:s'))
            ->where('heure_fin', '>=', $maintenant->format('H:i:s'))
            ->first();

        if (!$session) {
            return response()->json([
                'message' => 'Aucune session de présence active en ce moment.',
                'session' => null,
            ], 404);
        }

        return response()->json([
            'session' => [
                'id'             => $session->id,
                'nom'            => $session->nom,
                'date_presence'  => $session->date_presence,
                'heure_debut'    => $session->heure_debut,
                'heure_fin'      => $session->heure_fin,
                'point_presence' => [
                    'id'             => $session->pointPresence->id,
                    'nom'            => $session->pointPresence->nom,
                    'latitude'       => $session->pointPresence->latitude,
                    'longitude'      => $session->pointPresence->longitude,
                    'rayon_autorise' => $session->pointPresence->rayon_autorise,
                ],
            ],
        ]);
    }
}
