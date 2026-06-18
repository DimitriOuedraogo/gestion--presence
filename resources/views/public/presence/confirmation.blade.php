@extends('layouts.public')

@section('title', 'Présence enregistrée')

@section('content')

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 text-center">

    <div class="flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mx-auto mb-4">
        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
    </div>

    <h2 class="text-xl font-bold text-slate-800 mb-1">Présence enregistrée !</h2>
    <p class="text-slate-500 text-sm mb-6">Votre participation à la session a bien été prise en compte.</p>

    <div class="bg-slate-50 rounded-xl p-4 text-left space-y-2 mb-6">
        <div class="flex justify-between text-sm">
            <span class="text-slate-500">Agent</span>
            <span class="font-medium text-slate-800">{{ $agent->prenom }} {{ $agent->nom }}</span>
        </div>
        <div class="flex justify-between text-sm">
            <span class="text-slate-500">Session</span>
            <span class="font-medium text-slate-800">{{ $session->nom }}</span>
        </div>
        <div class="flex justify-between text-sm">
            <span class="text-slate-500">Date</span>
            <span class="font-medium text-slate-800">{{ $session->datePresenceFormatee }}</span>
        </div>
        <div class="flex justify-between text-sm">
            <span class="text-slate-500">Heure d'enregistrement</span>
            <span class="font-medium text-slate-800">{{ now()->format('H:i') }}</span>
        </div>
    </div>

    <p class="text-xs text-slate-400">Vous pouvez fermer cette page.</p>

</div>

@endsection
