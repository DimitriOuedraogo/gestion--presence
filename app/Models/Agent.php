<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Agent extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'structure',
        'qr_code_uuid',
        'actif',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'actif' => 'boolean',
        'qr_code_uuid' => 'string',
    ];

    // Relation avec HistoriqueConnexion
    public function historiqueConnexions()
    {
        return $this->hasMany(HistoriqueConnexion::class, 'agent_id');
    }
}