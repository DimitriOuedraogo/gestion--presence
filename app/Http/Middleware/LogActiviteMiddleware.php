<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\HistoriqueConnexion;
use Symfony\Component\HttpFoundation\Response;

class LogActiviteMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Enregistrer automatiquement l'activité
        HistoriqueConnexion::create([
            'agent_id'       => $request->user()?->id ?? null,
            'methode'        => $request->method(),
            'succes'         => $response->isSuccessful(),
            'adresse_ip'     => $request->ip(),
            'date_tentative' => now(),
        ]);

        return $response;
    }
}