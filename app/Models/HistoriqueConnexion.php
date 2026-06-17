<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriqueConnexion extends Model
{
    //

    protected $fillable = [
        'agent_id',
        'methode',
        'succes',
        'adresse_ip',
        'date_tentative',
    ];


    protected $casts = [
        'date_tentative' => 'datetime',
    ];

    public function agent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }
}
