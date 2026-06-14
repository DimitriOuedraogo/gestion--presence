<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Signature extends Model
{
    use HasFactory;

    protected $fillable = [
        'chemin_signature',
        'date_signature',
        'presence_id',
    ];

    protected $casts = [
        'date_signature' => 'date',
    ];

    public function presence(): BelongsTo
    {
        return $this->belongsTo(Presence::class);
    }
}