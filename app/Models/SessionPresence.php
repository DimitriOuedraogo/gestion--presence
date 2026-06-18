<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionPresence extends Model
{
    /** @use HasFactory<\Database\Factories\SessionPresenceFactory> */
    use HasFactory;

    protected $fillable = [
        'nom',
        'date_presence',
        'heure_debut',
        'heure_fin',
        'point_presence_id',
    ];

    protected function cast(): array
    {
        return [
            'date_presence' => 'datetime'
        ];
    }

    protected function datePresenceFormatee(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->date_presence
                ? Carbon::parse($this->date_presence)->format('d/m/Y')
                : ''
        );
    }

    protected function heureDebutFormatee(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->heure_debut
                ? Carbon::parse($this->heure_debut)->format('H:i')
                : ''
        );
    }

    protected function heureFinFormatee(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->heure_fin
                ? Carbon::parse($this->heure_fin)->format('H:i')
                : ''
        );
    }

    public function pointPresence(): BelongsTo
    {
        return $this->belongsTo(PointPresence::class);
    }
}
