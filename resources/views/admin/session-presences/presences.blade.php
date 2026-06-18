@extends('layouts.admin')

@section('title', 'Présences – ' . $session->nom)
@section('page-title', 'Présences')
@section('page-subtitle', 'Liste des agents ayant marqué leur présence')

@section('content')

<div class="flex items-center justify-between mb-5">
    <div>
        <a href="{{ route('admin.session-presences.index') }}"
           class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-slate-700 mb-2 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Retour aux sessions
        </a>
        <h2 class="text-xl font-bold text-slate-800">{{ $session->nom }}</h2>
        <p class="text-slate-500 text-sm mt-0.5">
            {{ $session->datePresenceFormatee }} &middot;
            {{ $session->heureDebutFormatee }} – {{ $session->heureFinFormatee }} &middot;
            {{ $session->pointPresence->nom ?? '—' }}
        </p>
    </div>

    <div class="flex items-center gap-3">
        <div class="flex flex-col items-end gap-1">
            <span class="text-2xl font-bold text-blue-600">{{ $session->presences->count() }}</span>
            <span class="text-xs text-slate-400 uppercase tracking-wide">présence(s)</span>
        </div>
        @if($session->presences->count() > 0)
        <a href="{{ route('admin.session-presences.presences.export', $session->id) }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 active:bg-blue-800 transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Exporter Excel
        </a>
        @endif
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">

    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
        <h3 class="font-semibold text-slate-700 text-sm">Agents présents</h3>
        @if($session->estActive())
            <span class="inline-flex items-center gap-1.5 text-xs font-medium text-green-700 bg-green-50 border border-green-200 px-3 py-1 rounded-full">
                <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                Session en cours
            </span>
        @else
            <span class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-500 bg-slate-100 border border-slate-200 px-3 py-1 rounded-full">
                Session terminée
            </span>
        @endif
    </div>

    @if ($session->presences->isEmpty())
    <div class="py-16 text-center">
        <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <h3 class="text-base font-semibold text-slate-700">Aucune présence</h3>
        <p class="text-slate-400 text-sm mt-1">Aucun agent n'a encore marqué sa présence.</p>
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-100">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Agent</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Téléphone</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Heure de marquage</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Adresse IP</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach ($session->presences as $index => $presence)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 text-sm text-slate-400">{{ $index + 1 }}</td>

                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                                <span class="text-sm font-semibold text-blue-600">
                                    {{ strtoupper(substr($presence->agent->prenom ?? '?', 0, 1)) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-800">
                                    {{ $presence->agent->prenom ?? '—' }} {{ $presence->agent->nom ?? '' }}
                                </p>
                                <p class="text-xs text-slate-400">{{ $presence->agent->matricule ?? '' }}</p>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-4 text-sm text-slate-500">
                        {{ $presence->agent->email ?? '—' }}
                    </td>

                    <td class="px-6 py-4 text-sm text-slate-600">
                        {{ $presence->agent->telephone ?? '—' }}
                    </td>

                    <td class="px-6 py-4 text-sm text-slate-600 font-medium">
                        {{ $presence->date_heure ? $presence->date_heure->format('H:i:s') : '—' }}
                    </td>

                    <td class="px-6 py-4 text-sm text-slate-400 font-mono">
                        {{ $presence->adresse_ip ?? '—' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

</div>

@endsection
