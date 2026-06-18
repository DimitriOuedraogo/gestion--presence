@extends('layouts.public')

@section('title', 'Marquer ma présence — ' . $session->nom)

@section('content')

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">

    {{-- En-tête session --}}
    <div class="mb-6">
        <span class="inline-block px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full mb-3">
            Session active
        </span>
        <h2 class="text-xl font-bold text-slate-800">{{ $session->nom }}</h2>
        <div class="mt-2 space-y-1 text-sm text-slate-500">
            <p>Date : <span class="font-medium text-slate-700">{{ $session->datePresenceFormatee }}</span></p>
            <p>Horaires : <span class="font-medium text-slate-700">{{ $session->heureDebutFormatee }} – {{ $session->heureFinFormatee }}</span></p>
            @if ($session->pointPresence)
            <p>Lieu : <span class="font-medium text-slate-700">{{ $session->pointPresence->nom }}</span></p>
            @endif
        </div>
    </div>

    <hr class="border-slate-200 mb-6">

    {{-- Formulaire --}}
    <form method="POST" action="{{ route('presence.publique.valider', $token) }}">
        @csrf

        <div class="mb-5">
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">
                Votre adresse email professionnelle
            </label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="prenom.nom@exemple.com"
                autocomplete="email"
                class="w-full px-4 py-3 rounded-xl border @error('email') border-red-400 bg-red-50 @else border-slate-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-800 placeholder-slate-400"
                required
            >
            @error('email')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition shadow-sm">
            Marquer ma présence
        </button>

    </form>

</div>

@endsection
