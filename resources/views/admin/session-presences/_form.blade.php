@csrf

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">

    <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
        <h2 class="text-lg font-semibold text-slate-900 tracking-tight">
            Informations de la session
        </h2>
        <p class="text-sm text-slate-500 mt-1">
            Configurez la plage horaire et le point de contrôle pour cette session de présence.
        </p>
    </div>

    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="md:col-span-2">
                <label for="nom" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Nom de la session
                </label>
                <input id="nom"
                    type="text"
                    name="nom"
                    value="{{ old('nom', $sessionPresence->nom ?? '') }}"
                    placeholder="Ex : Réunion Matinale, Service Technique Après-midi"
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

            <div class="md:col-span-2">
                <label for="point_presence_id" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Point de présence (Zone affectée)
                </label>
                <select id="point_presence_id"
                    name="point_presence_id"
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-slate-900 bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm transition-colors"
                    required>
                    <option value="">Sélectionner un emplacement</option>
                    @foreach($pointPresences as $point)
                    <option value="{{ $point->id }}" @selected(old('point_presence_id', $sessionPresence->point_presence_id ?? '') == $point->id)>
                        {{ $point->nom }}
                    </option>
                    @endforeach
                </select>
                @error('point_presence_id')
                <p class="mt-2 text-sm text-rose-600 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="md:col-span-2 lg:col-span-1">
                <label for="date_presence" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Date de présence
                </label>
                <input id="date_presence"
                    type="date"
                    name="date_presence"
                    value="{{ old('date_presence', $sessionPresence->date_presence ?? '') }}"
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm transition-colors"
                    required>
                @error('date_presence')
                <p class="mt-2 text-sm text-rose-600 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div>
                <label for="heure_debut" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Heure de début
                </label>
                <input id="heure_debut"
                    type="time"
                    name="heure_debut"
                    value="{{ old('heure_debut', $sessionPresence->heure_debut ?? '') }}"
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm font-mono transition-colors"
                    required>
                @error('heure_debut')
                <p class="mt-2 text-sm text-rose-600 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div>
                <label for="heure_fin" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Heure de fin
                </label>
                <input id="heure_fin"
                    type="time"
                    name="heure_fin"
                    value="{{ old('heure_fin', $sessionPresence->heure_fin ?? '') }}"
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm font-mono transition-colors"
                    required>
                @error('heure_fin')
                <p class="mt-2 text-sm text-rose-600 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>

        </div>
    </div>

    <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
        <a href="{{ route('admin.session-presences.index') }}"
            class="px-4 py-2.5 rounded-xl border border-slate-300 text-sm font-medium text-slate-700 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all duration-200">
            Annuler
        </a>
        <button type="submit"
            class="px-4 py-2.5 rounded-xl bg-emerald-600 text-sm font-medium text-white hover:bg-emerald-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all duration-200">
            Enregistrer la session
        </button>
    </div>

</div>