<?php

namespace App\Services;

class DistanceCalcul
{
    /**
     * Rayon moyen de la Terre, en mètres.
     */
    private const EARTH_RADIUS_METERS = 6371000;

    /**
     * Calcule la distance en mètres entre deux points GPS
     * en utilisant la formule de Haversine.
     */
    public function calculer(float $latitudeA, float $longitudeA, float $latitudeB, float $longitudeB): float
    {
        // 1. Convertir les degrés en radians (les fonctions trigonométriques de PHP travaillent en radians)
        $latRad1 = deg2rad($latitudeA);
        $latRad2 = deg2rad($latitudeB);
        $deltaLat = deg2rad($latitudeB - $latitudeA);
        $deltaLon = deg2rad($longitudeB - $longitudeA);

        // 2. Formule de Haversine
        $a = sin($deltaLat / 2) ** 2
           + cos($latRad1) * cos($latRad2) * sin($deltaLon / 2) ** 2;

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        // 3. Distance = rayon terrestre × angle central
        return self::EARTH_RADIUS_METERS * $c;
    }

    /**
     * Vérifie si une distance est dans le rayon autorisé.
     */
    public function estDansLeRayon(float $distanceMetres, int $rayonAutoriseMetres): bool
    {
        return $distanceMetres <= $rayonAutoriseMetres;
    }
}