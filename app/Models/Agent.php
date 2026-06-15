<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Agent extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'structure',
        'telephone',
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