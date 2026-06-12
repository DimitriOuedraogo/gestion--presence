<?php

namespace App\Services;

use App\Models\Agent;
use Illuminate\Support\Str;

class AgentService
{
    // Générer un QR code UUID unique pour un agent
    public function genererQrCode(Agent $agent): string
    {
        $uuid = Str::uuid()->toString();
        $agent->update(['qr_code_uuid' => $uuid]);
        return $uuid;
    }

    // Valider un QR code et retourner l'agent correspondant
    public function validerQrCode(string $uuid): ?Agent
    {
        return Agent::where('qr_code_uuid', $uuid)
                    ->where('actif', true)
                    ->first();
    }
}