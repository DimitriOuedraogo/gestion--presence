@extends('layouts.app')

@section('title', 'Enregistrement de présence')

@section('content')
<!-- Conteneur centré avec ajustements d'espacement pour s'intégrer au layout principal -->
<div class="py-6 flex flex-col justify-center items-center min-h-[calc(100vh-7rem)]">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-2xl shadow-sm border border-slate-100">

        <!-- En-tête de la carte -->
        <div class="text-center">
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                Enregistrement de présence
            </h1>
            <p class="mt-1.5 text-sm text-slate-500">
                Veuillez valider votre présence en partageant votre position.
            </p>
        </div>

        <!-- Alerte / Carte d'état GPS -->
        <div id="gps-card" class="bg-blue-50/50 border border-blue-100 rounded-xl p-4 flex items-start space-x-3 transition-all duration-300">
            <div id="gps-icon-container" class="p-2 bg-blue-500 text-white rounded-lg dynamic-pulse shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-blue-900">Signal Géographique</p>
                <div id="resultat" class="text-xs text-blue-700 mt-1 space-y-0.5">
                    <span class="inline-flex items-center font-medium">
                        <svg class="animate-spin -ml-1 mr-2 h-3.5 w-3.5 text-blue-600" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Calcul des coordonnées satellites...
                    </span>
                </div>
            </div>
        </div>

        <!-- Formulaire de soumission -->
        <form action="{{ route('presences.store') }}"
            method="POST"
            onsubmit="submitForm(event)"
            class="mt-6 space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Adresse Email professionnelle
                </label>
                <div class="relative rounded-xl shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                        </svg>
                    </div>
                    <input type="email"
                        id="email"
                        name="email"
                        class="block w-full pl-10 pr-4 py-2.5 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm transition-colors"
                        placeholder="nom@entreprise.com"
                        required>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit"
                    id="submitBtn"
                    disabled
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200">
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
            transform: scale(1.04);
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
        const submitBtn = document.getElementById('submitBtn');

        if (!navigator.geolocation) {
            updateGpsUI('error', "La géolocalisation n'est pas supportée par votre terminal.");
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
                <div class="grid grid-cols-2 gap-2 mt-2 text-xs font-mono bg-white/60 p-2.5 rounded-xl border border-emerald-100 text-slate-700">
                    <div><span class="text-slate-400 font-sans font-medium">Lat :</span> ${userPosition.latitude.toFixed(6)}</div>
                    <div><span class="text-slate-400 font-sans font-medium">Long :</span> ${userPosition.longitude.toFixed(6)}</div>
                    <div class="col-span-2 border-t border-slate-100 pt-1 mt-0.5">
                        <span class="text-slate-400 font-sans font-medium">Marge de précision :</span> ±${Math.round(userPosition.accuracy)}m
                    </div>
                </div>
            `;

            updateGpsUI('success', htmlContent);
            submitBtn.disabled = false;
            submitBtn.textContent = 'Valider ma présence';

        } catch (error) {
            let message = "Impossible d'intercepter votre position GPS.";
            switch (error.code) {
                case 1:
                    message = "Autorisation requise. Veuillez activer la localisation dans votre navigateur.";
                    break;
                case 2:
                    message = "Signal satellite introuvable ou indisponible.";
                    break;
                case 3:
                    message = "Temps de recherche réseau écoulé.";
                    break;
            }
            updateGpsUI('error', message);
            submitBtn.textContent = 'Signal GPS obligatoire';
        }
    });

    function updateGpsUI(state, message) {
        const resultElement = document.getElementById('resultat');
        const gpsCard = document.getElementById('gps-card');
        const gpsIconContainer = document.getElementById('gps-icon-container');

        gpsIconContainer.classList.remove('dynamic-pulse');

        if (state === 'success') {
            gpsCard.className = "bg-emerald-50 border border-emerald-100 rounded-xl p-4 flex items-start space-x-3 transition-all duration-300";
            gpsIconContainer.className = "p-2 bg-emerald-500 text-white rounded-lg";
            resultElement.innerHTML = message;
        } else if (state === 'error') {
            gpsCard.className = "bg-rose-50 border border-rose-100 rounded-xl p-4 flex items-start space-x-3 transition-all duration-300";
            gpsIconContainer.className = "p-2 bg-rose-500 text-white rounded-lg";
            resultElement.innerHTML = `<span class="text-rose-700 font-medium">${message}</span>`;
        }
    }

    async function submitForm(event) {
        event.preventDefault();
        const submitBtn = document.getElementById('submitBtn');

        if (!userPosition) {
            updateGpsUI('error', "Position manquante. Actualisez la page.");
            return;
        }

        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white inline mt-0.5" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg> Cryptage et envoi des données...
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
            if (!response.ok) throw new Error(data.message || 'Échec de la validation géographique');

            // Animation d'état de succès final épuré
            document.getElementById('gps-card').remove();
            event.target.remove();

            const successContainer = document.createElement('div');
            successContainer.className = "text-center py-8 space-y-3 bg-emerald-50/40 border border-emerald-100 rounded-2xl p-6 transition-all";
            successContainer.innerHTML = `
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-emerald-100 text-emerald-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h3 class="text-base font-semibold text-emerald-900">Enregistrement validé</h3>
                <p class="text-sm text-emerald-800">${data.message || 'Votre présence a été géolocalisée et enregistrée avec succès.'}</p>
            `;
            document.querySelector('.max-w-md').appendChild(successContainer);

        } catch (error) {
            console.error(error);
            updateGpsUI('error', error.message);
            submitBtn.disabled = false;
            submitBtn.textContent = 'Réessayer la validation';
        }
    }
</script>
@endsection