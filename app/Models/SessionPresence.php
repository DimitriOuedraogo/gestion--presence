<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionPresence extends Model
{
    /** @use HasFactory<\Database\Factories\SessionPresenceFactory> */
    use HasFactory;

    protected $fillable = [
        'date_presence',
        'heure_debut',
        'heure_fin',
        'point_presence_id',
    ];


    public function pointPresence(): BelongsTo
    {
        return $this->belongsTo(PointPresence::class);
    }
}
