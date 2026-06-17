@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8 flex flex-col justify-center items-center">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-2xl shadow-sm border border-gray-100">

        <div class="text-center">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                Enregistrement de présence
            </h1>
            <p class="mt-2 text-sm text-gray-500">
                Veuillez valider votre présence en partageant votre position.
            </p>
        </div>

        <div id="gps-card" class="bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-start space-x-3 transition-all duration-300">
            <div id="gps-icon-container" class="p-2 bg-blue-500 text-white rounded-lg dynamic-pulse">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0x" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-blue-900">Position GPS</p>
                <div id="resultat" class="text-xs text-blue-700 mt-1 space-y-0.5">
                    <span class="inline-flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Récupération des coordonnées en cours...
                    </span>
                </div>
            </div>
        </div>

        <form action="{{ route('presences.store') }}"
            method="POST"
            onsubmit="submitForm(event)"
            class="mt-8 space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                    Adresse Email
                </label>
                <div class="relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                        </svg>
                    </div>
                    <input type="email"
                        id="email"
                        name="email"
                        class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm transition-colors"
                        placeholder="nom@exemple.com"
                        required>
                </div>
            </div>

            <div>
                <button type="submit"
                    id="submitBtn"
                    disabled
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200">
                    En attente du signal GPS...
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    @keyframes pulse-slow {

        0%,
        100% {
            opacity: 1;
            transform: scale(1);
        }

        50% {
            opacity: 0.6;
            transform: scale(1.05);
        }
    }

    .dynamic-pulse {
        animation: pulse-slow 2s infinite ease-in-out;
    }
</style>

<script>
    let userPosition = null;

    function getCurrentPosition() {
        return new Promise((resolve, reject) => {
            navigator.geolocation.getCurrentPosition(
                resolve, reject, {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }
            );
        });
    }

    document.addEventListener('DOMContentLoaded', async () => {
        const resultElement = document.getElementById('resultat');
        const gpsCard = document.getElementById('gps-card');
        const gpsIconContainer = document.getElementById('gps-icon-container');
        const submitBtn = document.getElementById('submitBtn');

        if (!navigator.geolocation) {
            updateGpsUI('error', "La géolocalisation n'est pas supportée par ce navigateur.");
            return;
        }

        try {
            const position = await getCurrentPosition();

            userPosition = {
                latitude: position.coords.latitude,
                longitude: position.coords.longitude,
                accuracy: position.coords.accuracy
            };

            const htmlContent = `
                <div class="grid grid-cols-2 gap-2 mt-1 text-xs font-mono bg-white bg-opacity-50 p-2 rounded-lg border border-emerald-100">
                    <div><span class="text-gray-500">Lat :</span> ${userPosition.latitude.toFixed(5)}</div>
                    <div><span class="text-gray-500">Long :</span> ${userPosition.longitude.toFixed(5)}</div>
                    <div class="col-span-2"><span class="text-gray-500">Précision :</span> ±${Math.round(userPosition.accuracy)}m</div>
                </div>
            `;

            updateGpsUI('success', htmlContent);
            submitBtn.disabled = false;
            submitBtn.textContent = 'Soumettre ma présence';

        } catch (error) {
            let message = "Impossible d'obtenir votre position GPS.";
            switch (error.code) {
                case 1:
                    message = "Accès refusé. Veuillez autoriser la géolocalisation.";
                    break;
                case 2:
                    message = "Signal GPS indisponible.";
                    break;
                case 3:
                    message = "Temps d'attente dépassé.";
                    break;
            }
            updateGpsUI('error', message);
            submitBtn.textContent = 'Position GPS requise';
        }
    });

    function updateGpsUI(state, message) {
        const resultElement = document.getElementById('resultat');
        const gpsCard = document.getElementById('gps-card');
        const gpsIconContainer = document.getElementById('gps-icon-container');

        // Reset des classes de pulsation
        gpsIconContainer.classList.remove('dynamic-pulse');

        if (state === 'success') {
            gpsCard.className = "bg-emerald-50 border border-emerald-200 rounded-xl p-4 flex items-start space-x-3 transition-all duration-300";
            gpsIconContainer.className = "p-2 bg-emerald-500 text-white rounded-lg";
            resultElement.innerHTML = message;
        } else if (state === 'error') {
            gpsCard.className = "bg-rose-50 border border-rose-200 rounded-xl p-4 flex items-start space-x-3 transition-all duration-300";
            gpsIconContainer.className = "p-2 bg-rose-500 text-white rounded-lg";
            resultElement.innerHTML = `<span class="text-rose-700 font-medium">${message}</span>`;
        }
    }

    async function submitForm(event) {
        event.preventDefault();
        const resultElement = document.getElementById('resultat');
        const submitBtn = document.getElementById('submitBtn');

        if (!userPosition) {
            updateGpsUI('error', "Position GPS manquante. Soumission impossible.");
            return;
        }

        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg> Envoi en cours...
        `;

        try {
            const formData = new FormData(event.target);
            formData.append('latitude', userPosition.latitude);
            formData.append('longitude', userPosition.longitude);
            formData.append('accuracy', userPosition.accuracy);

            const response = await fetch(event.target.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (!response.ok) throw new Error(data.message || 'Erreur lors de la soumission');

            // Feedback de succès propre
            document.getElementById('gps-card').style.display = 'none';
            event.target.style.display = 'none';

            const successContainer = document.createElement('div');
            successContainer.className = "text-center py-6 space-y-3";
            successContainer.innerHTML = `
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-emerald-100 text-emerald-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <p class="text-sm font-medium text-emerald-800">${data.message || 'Présence validée avec succès !'}</p>
            `;
            document.querySelector('.max-w-md').appendChild(successContainer);

        } catch (error) {
            console.error(error);
            updateGpsUI('error', error.message);
            submitBtn.disabled = false;
            submitBtn.textContent = 'Réessayer la soumission';
        }
    }
</script>
@endsection