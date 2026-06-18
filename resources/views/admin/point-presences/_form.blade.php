@csrf

<div class="max-w-2xl mx-auto space-y-5">

    {{-- Carte principale --}}
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="text-base font-semibold text-slate-800">Informations du point</h2>
            <p class="text-sm text-slate-400 mt-0.5">Nom et zone géographique du lieu de pointage.</p>
        </div>

        <div class="p-6 space-y-5">

            {{-- Nom --}}
            <div>
                <label for="nom" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Nom du point <span class="text-red-500">*</span>
                </label>
                <input
                    id="nom" type="text" name="nom"
                    value="{{ old('nom', $pointPresence->nom ?? '') }}"
                    placeholder="Ex : Siège social, Salle A…"
                    class="w-full px-4 py-2.5 rounded-xl border @error('nom') border-red-400 bg-red-50 @else border-slate-200 @enderror bg-white text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition text-sm">
                @error('nom')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Rayon --}}
            <div>
                <label for="rayon_autorise" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Rayon autorisé (mètres) <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input
                        id="rayon_autorise" type="number" name="rayon_autorise"
                        value="{{ old('rayon_autorise', $pointPresence->rayon_autorise ?? '') }}"
                        placeholder="100"
                        class="w-full px-4 py-2.5 rounded-xl border @error('rayon_autorise') border-red-400 bg-red-50 @else border-slate-200 @enderror bg-white text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition text-sm pr-14">
                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs text-slate-400 font-medium">mètres</span>
                </div>
                @error('rayon_autorise')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

        </div>

    </div>

    {{-- Carte coordonnées GPS --}}
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-100">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-base font-semibold text-slate-800">Coordonnées GPS</h2>
                    <p class="text-sm text-slate-400 mt-0.5">Latitude et longitude du point de présence.</p>
                </div>
                <button
                    type="button"
                    id="btn-geolocate"
                    class="inline-flex items-center gap-2 px-3 py-2 text-xs font-semibold bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition border border-blue-200">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span id="btn-geolocate-label">Détecter ma position</span>
                </button>
            </div>
        </div>

        {{-- Bandeau statut GPS --}}
        <div id="geo-status-container" class="hidden px-6 pt-4">
            <div id="geo-status" class="flex items-center gap-2.5 px-4 py-3 rounded-xl text-sm font-medium"></div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                {{-- Latitude --}}
                <div>
                    <label for="latitude" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Latitude <span class="text-red-500">*</span>
                    </label>
                    <input
                        id="latitude" type="number" step="0.0000001" name="latitude"
                        value="{{ old('latitude', $pointPresence->latitude ?? '') }}"
                        placeholder="12.3714300"
                        class="w-full px-4 py-2.5 rounded-xl border @error('latitude') border-red-400 bg-red-50 @else border-slate-200 @enderror bg-white text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition text-sm font-mono">
                    @error('latitude')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Longitude --}}
                <div>
                    <label for="longitude" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Longitude <span class="text-red-500">*</span>
                    </label>
                    <input
                        id="longitude" type="number" step="0.0000001" name="longitude"
                        value="{{ old('longitude', $pointPresence->longitude ?? '') }}"
                        placeholder="-1.5196600"
                        class="w-full px-4 py-2.5 rounded-xl border @error('longitude') border-red-400 bg-red-50 @else border-slate-200 @enderror bg-white text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition text-sm font-mono">
                    @error('longitude')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>
            <p class="text-xs text-slate-400 mt-3">Vous pouvez aussi saisir les coordonnées manuellement.</p>
        </div>

    </div>

    {{-- Actions --}}
    <div class="flex items-center justify-end gap-3 pt-1 pb-4">
        <a href="{{ route('admin.point-presences.index') }}"
           class="px-5 py-2.5 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition">
            Annuler
        </a>
        <button type="submit"
                class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition shadow-sm">
            Enregistrer
        </button>
    </div>

</div>

@push('scripts')
<script>
(function () {
    const latInput        = document.getElementById('latitude');
    const lngInput        = document.getElementById('longitude');
    const statusEl        = document.getElementById('geo-status');
    const statusContainer = document.getElementById('geo-status-container');
    const btn             = document.getElementById('btn-geolocate');
    const btnLabel        = document.getElementById('btn-geolocate-label');

    function setStatus(texte, type) {
        const styles = {
            chargement: 'bg-blue-50 border border-blue-200 text-blue-700',
            succes:     'bg-green-50 border border-green-200 text-green-700',
            erreur:     'bg-amber-50 border border-amber-200 text-amber-700',
        };
        const icones = {
            chargement: '<svg class="w-4 h-4 animate-spin shrink-0" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/></svg>',
            succes:     '<svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>',
            erreur:     '<svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
        };
        statusContainer.classList.remove('hidden');
        statusEl.className = 'flex items-center gap-2.5 px-4 py-3 rounded-xl text-sm font-medium ' + (styles[type] ?? '');
        statusEl.innerHTML = (icones[type] ?? '') + '<span>' + texte + '</span>';
    }

    function detecter() {
        if (!navigator.geolocation) {
            setStatus('La géolocalisation n\'est pas supportée par ce navigateur.', 'erreur');
            return;
        }

        setStatus('Récupération de votre position en cours…', 'chargement');
        btn.disabled = true;
        btnLabel.textContent = 'Détection…';

        navigator.geolocation.getCurrentPosition(
            function (pos) {
                latInput.value = pos.coords.latitude.toFixed(7);
                lngInput.value = pos.coords.longitude.toFixed(7);
                setStatus('Position récupérée avec succès — vous pouvez modifier les valeurs si besoin.', 'succes');
                btn.disabled = false;
                btnLabel.textContent = 'Redétecter';
            },
            function (err) {
                const msg = { 1: 'Accès à la localisation refusé.', 2: 'Position non disponible.', 3: 'Délai d\'attente dépassé.' };
                setStatus((msg[err.code] ?? 'Erreur inconnue.') + ' Saisissez les coordonnées manuellement.', 'erreur');
                btn.disabled = false;
                btnLabel.textContent = 'Réessayer';
            },
            { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
        );
    }

    btn.addEventListener('click', detecter);

    // Déclenchement automatique uniquement sur le formulaire de création (champs vides)
    if (latInput.value === '') {
        detecter();
    }
}());
</script>
@endpush
