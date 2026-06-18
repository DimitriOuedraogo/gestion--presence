@extends('layouts.admin')

@section('title', 'Sessions')
@section('page-title', 'Sessions')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                Sessions de présence
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Planifiez et gérez les créneaux horaires de pointage pour vos équipes.
            </p>
        </div>

        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.session-presences.create') }}"
                class="inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all duration-200">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Nouvelle session
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">

        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <h2 class="text-xs font-semibold text-slate-700 uppercase tracking-wider">
                Planification actuelle
            </h2>
        </div>

        @if ($sessions->isEmpty())
        <div class="py-16 text-center max-w-sm mx-auto">
            <div class="inline-flex p-3 rounded-full bg-slate-100 text-slate-400 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <h3 class="text-base font-semibold text-slate-900">Aucune session disponible</h3>
            <p class="text-xs text-slate-500 mt-1">
                Il n'y a aucun créneau de présence configuré pour le moment.
            </p>
        </div>
        @else

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-slate-500 font-medium uppercase tracking-wider text-xs">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left">Nom de la session</th>
                        <th scope="col" class="px-6 py-4 text-left">Lieu affecté</th>
                        <th scope="col" class="px-6 py-4 text-left">Plage Horaire</th>
                        <th scope="col" class="px-6 py-4 text-center">Accès Émargement</th>
                        <th scope="col" class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 text-slate-700 bg-white">
                    @foreach ($sessions as $session)
                    <tr class="hover:bg-slate-50/70 transition-colors">

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-emerald-50 rounded-lg text-emerald-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="font-semibold text-slate-900">{{ $session->nom }}</span>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($session->pointPresence)
                            <span class="inline-flex items-center text-slate-700 font-medium">
                                <svg class="w-4 h-4 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                                {{ $session->pointPresence->nom }}
                            </span>
                            @else
                            <span class="text-slate-400 italic text-xs">Aucun lieu</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col text-xs">
                                <span class="font-semibold text-slate-900">{{ $session->datePresenceFormatee }}</span>
                                <span class="text-slate-500 mt-0.5">
                                    <span class="text-emerald-600 font-medium">{{ $session->heureDebutFormatee }}</span>
                                    à
                                    <span class="text-rose-600 font-medium">{{ $session->heureFinFormatee }}</span>
                                </span>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if(Carbon\Carbon::now()->lessThan($session->heure_fin))
                            <button onclick="openQrModal('{{ $session->nom }}', '{{ $session->id }}')"
                                class="inline-flex items-center px-3 py-1.5 bg-slate-900 hover:bg-slate-800 text-white font-medium rounded-xl text-xs transition-colors shadow-sm">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Générer QR
                            </button>
                            @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-medium bg-slate-100 text-slate-400 border border-slate-200">
                                Session expirée
                            </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.session-presences.edit', $session->id) }}"
                                    class="inline-flex items-center text-slate-600 hover:text-emerald-600 bg-slate-100 hover:bg-emerald-50 px-2.5 py-1.5 rounded-lg transition-colors text-xs font-medium">
                                    <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Modifier
                                </a>

                                <form action="{{ route('admin.session-presences.destroy', $session->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Voulez-vous vraiment supprimer définitivement cette session ?')"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center text-slate-600 hover:text-rose-600 bg-slate-100 hover:bg-rose-50 px-2.5 py-1.5 rounded-lg transition-colors text-xs font-medium">
                                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-16v6m-4 6V11m5 0V9a2 2 0 00-2-2M5 7h14" />
                                        </svg>
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
</div>

<div id="qrModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 transition-all">
    <div class="bg-white rounded-2xl max-w-sm w-full p-6 shadow-xl border border-slate-100 transform scale-95 transition-transform duration-300" id="modalCard">

        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <h3 class="text-base font-bold text-slate-900 truncate pr-4" id="modalSessionTitle">
                QR Code Session
            </h3>
            <button onclick="closeQrModal()" class="text-slate-400 hover:text-slate-600 transition-colors p-1 rounded-lg hover:bg-slate-50">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="py-8 flex flex-col items-center justify-center space-y-4">
            <div id="qrcode-canvas" class="p-4 bg-slate-50 border border-slate-100 rounded-2xl shadow-inner"></div>
            <p class="text-center text-xs text-slate-500 max-w-[240px]">
                Présentez ce code aux collaborateurs pour valider leur émargement par géolocalisation.
            </p>
        </div>

        <div class="pt-2">
            <button onclick="closeQrModal()" class="w-full py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-800 font-semibold rounded-xl text-sm transition-colors">
                Fermer la fenêtre
            </button>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>
    let qrEngine = null;

    function openQrModal(sessionNom, sessionId) {
        const modal = document.getElementById('qrModal');
        const card = document.getElementById('modalCard');
        const title = document.getElementById('modalSessionTitle');
        const canvas = document.getElementById('qrcode-canvas');

        title.textContent = `QR - ${sessionNom}`;
        canvas.innerHTML = ''; // Reset du canvas précédent

        // Construction de l'URL cible absolue vers le formulaire public d'émargement
        // Exemple généré : https://votre-domaine.com/presences?session_id=6
        const origin = window.location.origin.replace(/\/$/, "");

        // 2. On construit l'URL absolue vers la route "create" qu'on a vue ensemble
        const targetUrl = `${origin}/presences/create?session_id=${sessionId}`; // Initialisation de QRCodeJS
        qrEngine = new QRCode(canvas, {
            text: targetUrl.trim(),
            width: 180,
            height: 180,
            colorDark: "#0f172a", // Slate 900 pour un contraste maximal avec les scanners
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.Q // Haute tolérance aux erreurs (idéal pour projection sur écran ou impression)
        });

        // Affichage fluide de la modale
        modal.classList.remove('hidden');
        setTimeout(() => card.classList.remove('scale-95'), 10);
    }

    function closeQrModal() {
        const modal = document.getElementById('qrModal');
        const card = document.getElementById('modalCard');

        card.classList.add('scale-95');
        setTimeout(() => modal.classList.add('hidden'), 150);
    }

    // Fermeture automatique en appuyant sur la touche Échap
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeQrModal();
    });
</script>
@endsection