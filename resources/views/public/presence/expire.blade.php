@extends('layouts.public')

@section('title', 'Session expirée')

@section('content')

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 text-center">

    <div class="flex items-center justify-center w-16 h-16 bg-amber-100 rounded-full mx-auto mb-4">
        <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
    </div>

    <h2 class="text-xl font-bold text-slate-800 mb-1">Session non disponible</h2>
    <p class="text-slate-500 text-sm mb-6">
        Ce lien n'est plus actif. La session de présence est terminée ou n'a pas encore débuté.
    </p>

    <div class="bg-slate-50 rounded-xl p-4 text-left space-y-2">
        <div class="flex justify-between text-sm">
            <span class="text-slate-500">Session</span>
            <span class="font-medium text-slate-800">{{ $session->nom }}</span>
        </div>
        <div class="flex justify-between text-sm">
            <span class="text-slate-500">Date</span>
            <span class="font-medium text-slate-800">{{ $session->datePresenceFormatee }}</span>
        </div>
        <div class="flex justify-between text-sm">
            <span class="text-slate-500">Horaires</span>
            <span class="font-medium text-slate-800">{{ $session->heureDebutFormatee }} – {{ $session->heureFinFormatee }}</span>
        </div>
    </div>

    <p class="mt-6 text-xs text-slate-400">Contactez l'organisateur si vous pensez que c'est une erreur.</p>

</div>

@endsection
