@csrf

<div class="max-w-2xl mx-auto space-y-5">

    {{-- Carte principale --}}
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="text-base font-semibold text-slate-800">Informations de la session</h2>
            <p class="text-sm text-slate-400 mt-0.5">Configurez le nom, le lieu et la plage horaire.</p>
        </div>

        <div class="p-6 space-y-5">

            {{-- Nom --}}
            <div>
                <label for="nom" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Nom de la session <span class="text-red-500">*</span>
                </label>
                <input
                    id="nom" type="text" name="nom"
                    value="{{ old('nom', $session->nom ?? '') }}"
                    placeholder="Ex : Matinée du 17 juin, Formation PHP…"
                    class="w-full px-4 py-2.5 rounded-xl border @error('nom') border-red-400 bg-red-50 @else border-slate-200 @enderror bg-white text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition text-sm">
                @error('nom')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Point de présence --}}
            <div>
                <label for="point_presence_id" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Point de présence <span class="text-red-500">*</span>
                </label>
                <select
                    id="point_presence_id" name="point_presence_id"
                    class="w-full px-4 py-2.5 rounded-xl border @error('point_presence_id') border-red-400 bg-red-50 @else border-slate-200 @enderror bg-white text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition text-sm">
                    <option value="">Sélectionner un lieu…</option>
                    @foreach($pointPresences as $point)
                    <option value="{{ $point->id }}"
                        @selected(old('point_presence_id', $session->point_presence_id ?? '') == $point->id)>
                        {{ $point->nom }}
                    </option>
                    @endforeach
                </select>
                @error('point_presence_id')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

        </div>

    </div>

    {{-- Carte date et horaires --}}
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="text-base font-semibold text-slate-800">Date et horaires</h2>
            <p class="text-sm text-slate-400 mt-0.5">Définissez la plage pendant laquelle le lien sera actif.</p>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">

                {{-- Date --}}
                <div class="sm:col-span-3 md:col-span-1">
                    <label for="date_presence" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Date <span class="text-red-500">*</span>
                    </label>
                    <input
                        id="date_presence" type="date" name="date_presence"
                        value="{{ old('date_presence', isset($session) ? ($session->date_presence instanceof \Carbon\Carbon ? $session->date_presence->format('Y-m-d') : $session->date_presence) : '') }}"
                        class="w-full px-4 py-2.5 rounded-xl border @error('date_presence') border-red-400 bg-red-50 @else border-slate-200 @enderror bg-white text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition text-sm">
                    @error('date_presence')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Heure début --}}
                <div>
                    <label for="heure_debut" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Heure de début <span class="text-red-500">*</span>
                    </label>
                    <input
                        id="heure_debut" type="time" name="heure_debut"
                        value="{{ old('heure_debut', isset($session) ? ($session->heure_debut instanceof \Carbon\Carbon ? $session->heure_debut->format('H:i') : $session->heure_debut) : '') }}"
                        class="w-full px-4 py-2.5 rounded-xl border @error('heure_debut') border-red-400 bg-red-50 @else border-slate-200 @enderror bg-white text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition text-sm">
                    @error('heure_debut')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Heure fin --}}
                <div>
                    <label for="heure_fin" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Heure de fin <span class="text-red-500">*</span>
                    </label>
                    <input
                        id="heure_fin" type="time" name="heure_fin"
                        value="{{ old('heure_fin', isset($session) ? ($session->heure_fin instanceof \Carbon\Carbon ? $session->heure_fin->format('H:i') : $session->heure_fin) : '') }}"
                        class="w-full px-4 py-2.5 rounded-xl border @error('heure_fin') border-red-400 bg-red-50 @else border-slate-200 @enderror bg-white text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition text-sm">
                    @error('heure_fin')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-xl flex items-start gap-2.5">
                <svg class="w-4 h-4 text-blue-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-xs text-blue-700">
                    Le QR code et le lien de présence seront <strong>actifs uniquement pendant cette plage horaire</strong>.
                    En dehors, les participants verront une page "Session expirée".
                </p>
            </div>
        </div>

    </div>

    {{-- Actions --}}
    <div class="flex items-center justify-end gap-3 pt-1 pb-4">
        <a href="{{ route('admin.session-presences.index') }}"
           class="px-5 py-2.5 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition">
            Annuler
        </a>
        <button type="submit"
                class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition shadow-sm">
            Enregistrer la session
        </button>
    </div>

</div>
