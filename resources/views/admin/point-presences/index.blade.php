@extends('layouts.admin')

@section('title', 'Points de présence')
@section('page-title', 'Points de présence')

@section('content')

<!-- En-tête de page -->
<div class="sm:flex sm:items-center sm:justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
            Points de présence
        </h1>
        <p class="mt-1 text-sm text-slate-500">
            Configurez les zones géographiques (geofencing) où les agents peuvent valider leur présence.
        </p>
    </div>

    <div class="mt-4 sm:mt-0">
        <a href="{{ route('admin.point-presences.create') }}"
            class="inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all duration-200">
            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Nouveau point
        </a>
    </div>
</div>

<!-- Conteneur du Tableau -->
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-slate-500 font-medium uppercase tracking-wider text-xs">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left">Nom de la zone</th>
                    <th scope="col" class="px-6 py-4 text-left">Latitude</th>
                    <th scope="col" class="px-6 py-4 text-left">Longitude</th>
                    <th scope="col" class="px-6 py-4 text-left">Rayon autorisé</th>
                    <th scope="col" class="px-6 py-4 class='text-right' px-6 text-right">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100 text-slate-700 bg-white">
                @forelse($pointPresences as $point)
                <tr class="hover:bg-slate-50/70 transition-colors">

                    <!-- Nom -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-slate-100 rounded-lg text-slate-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <span class="font-semibold text-slate-900">{{ $point->nom }}</span>
                        </div>
                    </td>

                    <!-- Latitude -->
                    <td class="px-6 py-4 whitespace-nowrap font-mono text-xs text-slate-600">
                        {{ number_format($point->latitude, 6) }}
                    </td>

                    <!-- Longitude -->
                    <td class="px-6 py-4 whitespace-nowrap font-mono text-xs text-slate-600">
                        {{ number_format($point->longitude, 6) }}
                    </td>

                    <!-- Rayon -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                            <svg class="w-3 h-3 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 12a1 1 0 102 0 1 1 0 00-2 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $point->rayon_autorise }} m
                        </span>
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end space-x-3">

                            <!-- Modifier -->
                            <a href="{{ route('admin.point-presences.edit', $point->id) }}"
                                class="inline-flex items-center text-slate-600 hover:text-emerald-600 bg-slate-100 hover:bg-emerald-50 px-2.5 py-1.5 rounded-lg transition-colors text-xs font-medium">
                                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Modifier
                            </a>

                            <!-- Supprimer -->
                            <form action="{{ route('admin.point-presences.destroy', $point->id) }}"
                                method="POST"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce point de présence ?');"
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
                @empty
                <!-- État Vide -->
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="inline-flex p-3 rounded-full bg-slate-100 text-slate-400 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-slate-900">Aucun point de présence enregistré</p>
                        <p class="mt-1 text-xs text-slate-500">Commencez par ajouter un emplacement géographique cible.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination ou métadonnées en bas de page -->
@if($pointPresences->count() > 0)
<div class="mt-4 flex justify-between items-center px-2">
    <span class="text-xs text-slate-500 font-medium uppercase tracking-wider">
        Total : {{ $pointPresences->count() }} point(s) de présence configuré(s)
    </span>
</div>
@endif

@endsection