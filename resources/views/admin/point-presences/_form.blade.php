@csrf

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">

    <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
        <h2 class="text-lg font-semibold text-slate-900 tracking-tight">
            Informations du point de présence
        </h2>
        <p class="text-sm text-slate-500 mt-1">
            Renseignez les coordonnées GPS et le rayon de validation (Geofencing).
        </p>
    </div>

    <div class="p-6 space-y-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="md:col-span-2">
                <label for="nom" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Nom du point
                </label>
                <input id="nom"
                    type="text"
                    name="nom"
                    value="{{ old('nom', $pointPresence->nom ?? '') }}"
                    placeholder="Ex : Siège social, Bureau Annexe"
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm transition-colors"
                    required>
                @error('nom')
                <p class="mt-2 text-sm text-rose-600 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div>
                <label for="latitude" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Latitude
                </label>
                <input id="latitude"
                    type="number"
                    step="0.0000001"
                    name="latitude"
                    value="{{ old('latitude', $pointPresence->latitude ?? '') }}"
                    placeholder="12.3714300"
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-xl font-mono text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                    required>
                @error('latitude')
                <p class="mt-2 text-sm text-rose-600 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div>
                <label for="longitude" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Longitude
                </label>
                <input id="longitude"
                    type="number"
                    step="0.0000001"
                    name="longitude"
                    value="{{ old('longitude', $pointPresence->longitude ?? '') }}"
                    placeholder="-1.5196600"
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-xl font-mono text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                    required>
                @error('longitude')
                <p class="mt-2 text-sm text-rose-600 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="rayon_autorise" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Rayon autorisé (mètres)
                </label>
                <input id="rayon_autorise"
                    type="number"
                    name="rayon_autorise"
                    value="{{ old('rayon_autorise', $pointPresence->rayon_autorise ?? '100') }}"
                    placeholder="100"
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm transition-colors"
                    required>
                @error('rayon_autorise')
                <p class="mt-2 text-sm text-rose-600 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

        </div>

        <div class="pt-2">
            <button type="button"
                id="btn-geoloc"
                class="inline-flex items-center px-4 py-2.5 border border-slate-200 rounded-xl shadow-sm text-xs font-semibold text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all duration-200">
                <svg class="h-4 w-4 text-emerald-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Détecter ma position actuelle
            </button>
            <div id="gps-status" class="mt-2 text-xs font-medium transition-all duration-200"></div>
        </div>

    </div>

    <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
        <a href="{{ route('admin.point-presences.index') }}"
            class="px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium text-slate-700 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all duration-200">
            Annuler
        </a>
        <button type="submit"
            class="px-4 py-2.5 rounded-xl bg-emerald-600 text-sm font-medium text-white hover:bg-emerald-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all duration-200">
            Enregistrer le point
        </button>
    </div>

</div>