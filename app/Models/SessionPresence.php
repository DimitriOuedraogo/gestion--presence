<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionPresence extends Model
{
    /** @use HasFactory<\Database\Factories\SessionPresenceFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'date_presence',
        'heure_debut',
        'heure_fin',
        'point_presence_id',
    ];


    public function pointPresence()
    {
        return $this->belongsTo(PointPresence::class);
    }
}
