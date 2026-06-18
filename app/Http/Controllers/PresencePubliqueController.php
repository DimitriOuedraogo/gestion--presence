<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Presence;
use App\Models\SessionPresence;
use Illuminate\Http\Request;

class PresencePubliqueController extends Controller
{
    public function afficher(string $token)
    {
        $session = SessionPresence::where('token', $token)->firstOrFail();

        if (! $session->estActive()) {
            return view('public.presence.expire', compact('session'));
        }

        return view('public.presence.formulaire', compact('session', 'token'));
    }

    public function valider(Request $request, string $token)
    {
        $session = SessionPresence::where('token', $token)->firstOrFail();

        if (! $session->estActive()) {
            return view('public.presence.expire', compact('session'));
        }

        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Veuillez saisir votre adresse email.',
            'email.email'    => 'L\'adresse email saisie n\'est pas valide.',
        ]);

        $agent = Agent::where('email', $request->email)->where('actif', true)->first();

        if (! $agent) {
            return back()
                ->withErrors(['email' => 'Aucun agent actif trouvé avec cette adresse email.'])
                ->withInput();
        }

        $adresseIp = $request->ip();

        // Anti-fraude : un agent ne peut marquer qu'une seule fois par session
        $dejaMarque = Presence::where('session_presence_id', $session->id)
            ->where('agent_id', $agent->id)
            ->exists();

        if ($dejaMarque) {
            return back()
                ->withErrors(['email' => 'Votre présence a déjà été enregistrée pour cette session.'])
                ->withInput();
        }

        // Anti-fraude : une IP ne peut être associée qu'à un seul agent par session
        $ipDejaUtilisee = Presence::where('session_presence_id', $session->id)
            ->where('adresse_ip', $adresseIp)
            ->where('agent_id', '!=', $agent->id)
            ->exists();

        if ($ipDejaUtilisee) {
            return back()
                ->withErrors(['email' => 'Une présence a déjà été enregistrée depuis votre réseau pour cette session.'])
                ->withInput();
        }

        Presence::create([
            'date_heure'         => now(),
            'valide'             => true,
            'agent_id'           => $agent->id,
            'session_presence_id' => $session->id,
            'adresse_ip'         => $adresseIp,
            'appareil'           => substr($request->userAgent() ?? '', 0, 45),
        ]);

        return view('public.presence.confirmation', compact('agent', 'session'));
    }
}
