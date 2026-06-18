@extends('layouts.admin')

@section('title', 'Créer un point de présence')
@section('page-title', 'Créer un point de présence')

@section('content')
<div class="max-w-3xl mx-auto">

    <form action="{{ route('admin.point-presences.store') }}" method="POST">
        @include('admin.point-presences._form')
    </form>

</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const latitudeInput = document.getElementById('latitude');
        const longitudeInput = document.getElementById('longitude');
        const status = document.getElementById('gps-status');
        const btnGeoloc = document.getElementById('btn-geoloc');

        function loadLocation() {
            if (!navigator.geolocation) {
                status.className = "mt-2 text-xs font-medium text-rose-600";
                status.innerHTML = "La géolocalisation n'est pas supportée par ce navigateur.";
                return;
            }

            status.className = "mt-2 text-xs font-medium text-blue-600 flex items-center";
            status.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg> Recherche du signal satellite...
            `;

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    latitudeInput.value = position.coords.latitude.toFixed(7);
                    longitudeInput.value = position.coords.longitude.toFixed(7);

                    status.className = "mt-2 text-xs font-medium text-emerald-600";
                    status.innerHTML = `✓ Coordonnées synchronisées (Précision : ±${Math.round(position.coords.accuracy)}m)`;
                },
                (error) => {
                    let message = 'Impossible de récupérer la position.';
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            message = 'Accès à la géolocalisation refusé par l\'administrateur.';
                            break;
                        case error.POSITION_UNAVAILABLE:
                            message = 'Signal GPS instable ou indisponible.';
                            break;
                        case error.TIMEOUT:
                            message = 'Temps d\'attente dépassé (délai d\'obtention expiré).';
                            break;
                    }
                    status.className = "mt-2 text-xs font-medium text-rose-600";
                    status.innerHTML = `✕ ${message}`;
                }, {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }
            );
        }

        // Chargement automatique à l'ouverture de l'écran
        loadLocation();

        // Écouteur sur le bouton manuel
        btnGeoloc.addEventListener('click', loadLocation);
    });
</script>
@endsection