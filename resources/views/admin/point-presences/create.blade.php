@extends('layouts.admin')

@section('title', 'Créer un point de présence')
@section('page-title', 'Créer un point de présence')


@section('content')

<div class="max-w-3xl mx-auto bg-white">

    <!-- <h1 class="text-xl font-bold mb-6">
        Nouveau point de présence
    </h1> -->

    <form
        action="{{ route('admin.point-presences.store') }}"
        method="POST">
        @include('admin.point-presences._form')


    </form>

</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        const latitudeInput = document.getElementById('latitude');
        const longitudeInput = document.getElementById('longitude');
        const status = document.getElementById('gps-status');

        function loadLocation() {

            if (!navigator.geolocation) {
                status.innerHTML =
                    '<span class="text-red-600">La géolocalisation n\'est pas supportée.</span>';
                return;
            }

            status.innerHTML = 'Récupération de la position GPS...';

            navigator.geolocation.getCurrentPosition(
                (position) => {

                    latitudeInput.value = position.coords.latitude;
                    longitudeInput.value = position.coords.longitude;

                    status.innerHTML =
                        `<span class="text-green-600">
                        Position récupérée avec succès
                        (précision : ${Math.round(position.coords.accuracy)} m)
                    </span>`;
                },

                (error) => {

                    let message = 'Erreur GPS';

                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            message = 'Accès à la localisation refusé';
                            break;

                        case error.POSITION_UNAVAILABLE:
                            message = 'Position indisponible';
                            break;

                        case error.TIMEOUT:
                            message = 'Temps d\'attente dépassé';
                            break;
                    }

                    status.innerHTML =
                        `<span class="text-red-600">${message}</span>`;
                },

                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }
            );
        }

        // Chargement automatique à l'ouverture de la page
        loadLocation();

        // Rechargement manuel via le bouton
        document
            .getElementById('btn-geoloc')
            .addEventListener('click', loadLocation);
    });
</script>

@endsection