@extends('layouts.admin')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')
@section('page-subtitle', 'Vue d\'ensemble de l\'activité')

@section('content')

@php
    $totalAgents   = \App\Models\Agent::count();
    $totalSessions = \App\Models\SessionPresence::count();
    $totalPoints   = \App\Models\PointPresence::count();
    $presencesAujourdhui = \App\Models\Presence::whereDate('date_heure', today())->count();

    $dernieresSessions = \App\Models\SessionPresence::with('pointPresence')
        ->orderByDesc('date_presence')->limit(5)->get();
@endphp

{{-- Cartes statistiques --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">

    <div class="bg-white rounded-2xl border border-slate-200 p-5 flex items-center gap-4">
        <div class="w-11 h-11 bg-blue-50 rounded-xl flex items-center justify-center shrink-0">
            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <div>
            <p class="text-xs text-slate-500 font-medium">Agents</p>
            <p class="text-2xl font-bold text-slate-800 mt-0.5">{{ $totalAgents }}</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-5 flex items-center gap-4">
        <div class="w-11 h-11 bg-violet-50 rounded-xl flex items-center justify-center shrink-0">
            <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
        <div>
            <p class="text-xs text-slate-500 font-medium">Sessions</p>
            <p class="text-2xl font-bold text-slate-800 mt-0.5">{{ $totalSessions }}</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-5 flex items-center gap-4">
        <div class="w-11 h-11 bg-emerald-50 rounded-xl flex items-center justify-center shrink-0">
            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div>
            <p class="text-xs text-slate-500 font-medium">Présences aujourd'hui</p>
            <p class="text-2xl font-bold text-slate-800 mt-0.5">{{ $presencesAujourdhui }}</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-5 flex items-center gap-4">
        <div class="w-11 h-11 bg-amber-50 rounded-xl flex items-center justify-center shrink-0">
            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <div>
            <p class="text-xs text-slate-500 font-medium">Points de présence</p>
            <p class="text-2xl font-bold text-slate-800 mt-0.5">{{ $totalPoints }}</p>
        </div>
    </div>

</div>

{{-- Dernières sessions --}}
<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">

    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
        <h2 class="font-semibold text-slate-700 text-sm">Dernières sessions</h2>
        <a href="{{ route('admin.session-presences.index') }}"
           class="text-xs text-blue-600 hover:text-blue-700 font-medium">
            Voir tout →
        </a>
    </div>

    @if ($dernieresSessions->isEmpty())
    <div class="py-12 text-center text-slate-400 text-sm">Aucune session enregistrée.</div>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-100">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Session</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Lieu</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Horaires</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach ($dernieresSessions as $session)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-3 text-sm font-medium text-slate-800">{{ $session->nom }}</td>
                    <td class="px-6 py-3 text-sm text-slate-500">{{ $session->pointPresence->nom ?? '—' }}</td>
                    <td class="px-6 py-3 text-sm text-slate-500">{{ $session->datePresenceFormatee }}</td>
                    <td class="px-6 py-3 text-sm text-slate-500">{{ $session->heureDebutFormatee }} – {{ $session->heureFinFormatee }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

</div>

@endsection
