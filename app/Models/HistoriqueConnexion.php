<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriqueConnexion extends Model
{
    protected $fillable = [
        'agent_id',
        'methode',
        'succes',
        'adresse_ip',
        'date_tentative',
    ];

    protected $casts = [
        'succes' => 'boolean',
        'date_tentative' => 'datetime',
    ];

    // Relation avec Agent
    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }
}