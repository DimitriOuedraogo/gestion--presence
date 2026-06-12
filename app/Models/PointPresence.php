<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointPresence extends Model
{
    /** @use HasFactory<\Database\Factories\PointPresenceFactory> */
    use HasFactory;
    protected $fillable = [
        'id',
        'date_presence',
        'nom',
        'latitude',
        'longitude',
        'rayon_autorise',
    ];
    

    public function sessions()
    {
        return $this->hasMany(SessionPresence::class);
    }

}
