@csrf

<div class="bg-white shadow-sm border border-slate-200 rounded-2xl">

    <div class="px-6 py-5 border-b border-slate-200">
        <h2 class="text-lg font-semibold text-slate-800">
            Informations de la session
        </h2>

        <p class="text-sm text-slate-500 mt-1">
            Configurez la période de présence.
        </p>
    </div>

    <div class="p-6">

        

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nom -->
            <div class="md:col-span-2">
                <label
                    for="nom"
                    class="block text-sm font-medium text-slate-700 mb-2">
                    Nom de la session
                </label>
                <input
                    id="nom"
                    type="text"
                    name="nom"
                    value="{{ old('nom', $session->nom ?? '') }}"
                    placeholder="Ex : Matinée du 12 juin"
                    class="w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                @error('nom')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <!-- Point de présence -->
            <div class="md:col-span-2">

                <label
                    for="point_presence_id"
                    class="block text-sm font-medium text-slate-700 mb-2">
                    Point de présence
                </label>

                <select
                    id="point_presence_id"
                    name="point_presence_id"
                    class="w-full border-slate-300">

                    <option value="">
                        Sélectionner un point
                    </option>

                    @foreach($pointPresences as $point)

                    <option
                        value="{{ $point->id }}"
                        @selected(
                        old( 'point_presence_id' ,
                        $session->point_presence_id ?? ''
                        ) == $point->id
                        )
                        >
                        {{ $point->nom }}
                    </option>

                    @endforeach

                </select>

                @error('point_presence_id')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
                @enderror

            </div>

            <!-- Date -->

            <div>

                <label
                    for="date_presence"
                    class="block text-sm font-medium text-slate-700 mb-2">
                    Date de présence
                </label>

                <input
                    id="date_presence"
                    type="date"
                    name="date_presence"
                    value="{{ old('date_presence', isset($session) ? $session->date_presence?->format('Y-m-d') : '') }}"
                    class="w-full border-slate-300">

                @error('date_presence')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
                @enderror

            </div>

            <!-- Heure début -->

            <div>

                <label
                    for="heure_debut"
                    class="block text-sm font-medium text-slate-700 mb-2">
                    Heure de début
                </label>

                <input
                    id="heure_debut"
                    type="time"
                    name="heure_debut"
                    value="{{ old('heure_debut', isset($session) ? $session->heure_debut?->format('H:i:s') : '') }}"
                    class="w-full border-slate-300">

                @error('heure_debut')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
                @enderror

            </div>

            <!-- Heure fin -->

            <div>

                <label
                    for="heure_fin"
                    class="block text-sm font-medium text-slate-700 mb-2">
                    Heure de fin
                </label>

                <input
                    id="heure_fin"
                    type="time"
                    name="heure_fin"
                    value="{{ old('heure_fin', isset($session) ? $session->heure_fin?->format('H:i:s') : '') }}"
                    class="w-full border-slate-300">

                @error('heure_fin')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
                @enderror

            </div>

        </div>

    </div>

    <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex justify-end gap-3">

        <a
            href="{{ route('admin.session-presences.index') }}"
            class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100">
            Annuler
        </a>

        <button
            type="submit"
            class="px-5 py-2.5 rounded-xl bg-blue-600 text-white hover:bg-blue-700">
            Enregistrer
        </button>

    </div>

</div>