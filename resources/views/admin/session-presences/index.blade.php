@extends('layouts.admin')

@section('title', 'Sessions de présence')
@section('page-title', 'Sessions')
@section('page-subtitle', 'Gérez les sessions de formation et de présence')

@section('content')

<div class="flex items-center justify-between mb-5">
    <div>
        <h2 class="text-xl font-bold text-slate-800">Sessions de présence</h2>
        <p class="text-slate-500 text-sm mt-0.5">{{ $sessions->count() }} session(s) enregistrée(s)</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.session-presences.regenerer-qr') }}"
           onclick="return confirm('Régénérer tous les QR codes avec la nouvelle URL du serveur ?')"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-100 text-slate-700 text-sm font-semibold rounded-xl hover:bg-slate-200 transition border border-slate-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Régénérer QR
        </a>
        <a href="{{ route('admin.session-presences.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nouvelle session
        </a>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">

    <div class="px-6 py-4 border-b border-slate-100">
        <h3 class="font-semibold text-slate-700 text-sm">Liste des sessions</h3>
    </div>

    @if ($sessions->isEmpty())
    <div class="py-16 text-center">
        <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
        <h3 class="text-base font-semibold text-slate-700">Aucune session</h3>
        <p class="text-slate-400 text-sm mt-1 mb-5">Créez votre première session de présence.</p>
        <a href="{{ route('admin.session-presences.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-xl hover:bg-blue-700 transition">
            Créer une session
        </a>
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-100">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Session</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Lieu</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Date & Horaires</th>
                    <th class="px-6 py-3.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Lien / QR</th>
                    <th class="px-6 py-3.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach ($sessions as $session)
                <tr class="hover:bg-slate-50 transition-colors">

                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span class="font-medium text-slate-800 text-sm">{{ $session->nom }}</span>
                        </div>
                    </td>

                    <td class="px-6 py-4 text-sm text-slate-500">
                        {{ $session->pointPresence->nom ?? '—' }}
                    </td>

                    <td class="px-6 py-4">
                        <p class="text-sm font-medium text-slate-700">{{ $session->datePresenceFormatee }}</p>
                        <p class="text-xs text-slate-400 mt-0.5">{{ $session->heureDebutFormatee }} – {{ $session->heureFinFormatee }}</p>
                    </td>

                    {{-- Lien / QR --}}
                    <td class="px-6 py-4">
                        @if ($session->token)
                        <div class="flex flex-col items-center gap-1.5">
                            <button
                                type="button"
                                onclick="copierLien('{{ route('presence.publique.afficher', $session->token) }}', this)"
                                class="inline-flex items-center gap-1.5 text-xs px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition border border-blue-200 font-medium">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                                <span>Copier le lien</span>
                            </button>
                            @if ($session->qr_code_chemin)
                            <button
                                type="button"
                                onclick="document.getElementById('modal-qr-{{ $session->id }}').classList.remove('hidden')"
                                class="inline-flex items-center gap-1.5 text-xs px-3 py-1.5 bg-slate-100 text-slate-600 rounded-lg hover:bg-slate-200 transition font-medium">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                </svg>
                                <span>Voir QR code</span>
                            </button>
                            @endif
                        </div>
                        @else
                        <span class="text-xs text-slate-300 block text-center">—</span>
                        @endif
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-3">
                            <a href="{{ route('admin.session-presences.presences', $session->id) }}"
                               class="text-sm font-medium text-green-600 hover:text-green-800 transition">
                                Présences
                            </a>
                            <a href="{{ route('admin.session-presences.edit', $session->id) }}"
                               class="text-sm font-medium text-blue-600 hover:text-blue-800 transition">
                                Modifier
                            </a>
                            <form action="{{ route('admin.session-presences.destroy', $session->id) }}" method="POST"
                                  onsubmit="return confirm('Supprimer cette session de présence ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm font-medium text-red-500 hover:text-red-700 transition">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

</div>

@endsection

{{-- Modals QR code --}}
@foreach ($sessions as $session)
@if ($session->token && $session->qr_code_chemin)
<div id="modal-qr-{{ $session->id }}"
     class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4"
     onclick="if(event.target===this) this.classList.add('hidden')">
    <div class="bg-white rounded-2xl shadow-xl p-6 max-w-xs w-full text-center">
        <h3 class="font-bold text-slate-800 text-base">{{ $session->nom }}</h3>
        <p class="text-xs text-slate-400 mt-1 mb-4">{{ $session->datePresenceFormatee }} · {{ $session->heureDebutFormatee }}–{{ $session->heureFinFormatee }}</p>
        <div class="flex justify-center mb-4 p-3 bg-slate-50 rounded-xl border border-slate-200">
            <img src="{{ asset('storage/' . $session->qr_code_chemin) }}?v={{ $session->updated_at->timestamp }}"
                 alt="QR {{ $session->nom }}" class="w-44 h-44">
        </div>
        <p class="text-xs text-slate-400 break-all mb-4">{{ route('presence.publique.afficher', $session->token) }}</p>
        <button type="button"
                onclick="document.getElementById('modal-qr-{{ $session->id }}').classList.add('hidden')"
                class="w-full py-2.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl transition text-sm font-medium">
            Fermer
        </button>
    </div>
</div>
@endif
@endforeach

@push('scripts')
<script>
function copierLien(url, btn) {
    navigator.clipboard.writeText(url).then(() => {
        const span = btn.querySelector('span');
        const original = span.textContent;
        span.textContent = 'Copié !';
        btn.classList.remove('text-blue-700', 'bg-blue-50', 'border-blue-200');
        btn.classList.add('text-green-700', 'bg-green-50', 'border-green-200');
        setTimeout(() => {
            span.textContent = original;
            btn.classList.remove('text-green-700', 'bg-green-50', 'border-green-200');
            btn.classList.add('text-blue-700', 'bg-blue-50', 'border-blue-200');
        }, 2000);
    });
}
</script>
@endpush
