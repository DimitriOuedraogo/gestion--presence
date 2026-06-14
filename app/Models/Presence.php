<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Presence extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_heure',
        'latitude',
        'longitude',
        'distance_metre',
        'appareil',
        'valide',
        'session_presence_id',
        'agent_id',
    ];

    protected $casts = [
        'date_heure'     => 'datetime',
        'latitude'       => 'decimal:8',
        'longitude'      => 'decimal:8',
        'distance_metre' => 'decimal:2',
        'valide'         => 'boolean',
    ];

    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }

    public function sessionPresence(): BelongsTo
    {
        return $this->belongsTo(SessionPresence::class);
    }

    public function signature(): HasOne
    {
        return $this->hasOne(Signature::class);
    }
}
