@csrf


<div class="bg-white shadow-sm border border-slate-200">

    <div class="px-6 py-5 border-b border-slate-200">
        <h2 class="text-lg font-semibold text-slate-800">
            Informations du point de présence
        </h2>

        <p class="text-sm text-slate-500 mt-1">
            Renseignez les coordonnées GPS et le rayon autorisé.
        </p>
    </div>

    <div class="p-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Nom -->
            <div class="md:col-span-2">
                <label
                    for="nom"
                    class="block text-sm font-medium text-slate-700 mb-2">
                    Nom du point
                </label>

                <input
                    id="nom"
                    type="text"
                    name="nom"
                    value="{{ old('nom', $pointPresence->nom ?? '') }}"
                    placeholder="Ex : Siège social"
                    class="w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500">

                @error('nom')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <!-- Latitude -->
            <div>
                <label
                    for="latitude"
                    class="block text-sm font-medium text-slate-700 mb-2">
                    Latitude
                </label>

                <input
                    id="latitude"
                    type="number"
                    step="0.0000001"
                    name="latitude"
                    value="{{ old('latitude', $pointPresence->latitude ?? '') }}"
                    placeholder="12.3714300"
                    class="w-full border-slate-400 ">

                @error('latitude')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <!-- Longitude -->
            <div>
                <label
                    for="longitude"
                    class="block text-sm font-medium text-slate-700 mb-2">
                    Longitude
                </label>

                <input
                    id="longitude"
                    type="number"
                    step="0.0000001"
                    name="longitude"
                    value="{{ old('longitude', $pointPresence->longitude ?? '') }}"
                    placeholder="-1.5196600"
                    class="w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500">

                @error('longitude')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <!-- Rayon -->
            <div>
                <label
                    for="rayon_autorise"
                    class="block text-sm font-medium text-slate-700 mb-2">
                    Rayon autorisé (mètres)
                </label>

                <input
                    id="rayon_autorise"
                    type="number"
                    name="rayon_autorise"
                    value="{{ old('rayon_autorise', $pointPresence->rayon_autorise ?? '') }}"
                    placeholder="100"
                    class="w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500">

                @error('rayon_autorise')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
                @enderror
            </div>

        </div>
        <div class="md:col-span-2">
            <button
                type="button"
                id="btn-geoloc"
                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Obtenir ma position GPS
            </button>

            <p id="gps-status" class="mt-2 text-sm text-slate-500"></p>
        </div>

    </div>

    <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex justify-end gap-3">

        <a
            href="{{ route('admin.point-presences.index') }}"
            class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100 transition">
            Annuler
        </a>

        <button
            type="submit"
            class="px-5 py-2.5 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition shadow-sm">
            Enregistrer
        </button>

    </div>

</div>