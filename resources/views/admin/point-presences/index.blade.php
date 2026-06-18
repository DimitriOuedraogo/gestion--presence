@extends('layouts.admin')

@section('title', 'Points de présence')
@section('page-title', 'Points de présence')
@section('page-subtitle', 'Gérez les lieux de pointage GPS')

@section('content')

<div class="flex items-center justify-between mb-5">
    <div>
        <h2 class="text-xl font-bold text-slate-800">Points de présence</h2>
        <p class="text-slate-500 text-sm mt-0.5">{{ $pointPresences->count() }} point(s) enregistré(s)</p>
    </div>
    <a href="{{ route('admin.point-presences.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nouveau point
    </a>
</div>

<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">

    <div class="px-6 py-4 border-b border-slate-100">
        <h3 class="font-semibold text-slate-700 text-sm">Liste des points</h3>
    </div>

    @if ($pointPresences->isEmpty())
    <div class="py-16 text-center">
        <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <h3 class="text-base font-semibold text-slate-700">Aucun point de présence</h3>
        <p class="text-slate-400 text-sm mt-1 mb-5">Commencez par créer votre premier point GPS.</p>
        <a href="{{ route('admin.point-presences.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-xl hover:bg-blue-700 transition">
            Créer un point
        </a>
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-100">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Latitude</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Longitude</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Rayon autorisé</th>
                    <th class="px-6 py-3.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach ($pointPresences as $point)
                <tr class="hover:bg-slate-50 transition-colors">

                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-amber-50 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <span class="font-medium text-slate-800 text-sm">{{ $point->nom }}</span>
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        <span class="font-mono text-xs text-slate-600 bg-slate-100 px-2 py-1 rounded-md">{{ $point->latitude }}</span>
                    </td>

                    <td class="px-6 py-4">
                        <span class="font-mono text-xs text-slate-600 bg-slate-100 px-2 py-1 rounded-md">{{ $point->longitude }}</span>
                    </td>

                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1 text-sm text-slate-700">
                            {{ $point->rayon_autorise }}
                            <span class="text-xs text-slate-400">m</span>
                        </span>
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-3">
                            <a href="{{ route('admin.point-presences.edit', $point->id) }}"
                               class="text-sm font-medium text-blue-600 hover:text-blue-800 transition">
                                Modifier
                            </a>
                            <form action="{{ route('admin.point-presences.destroy', $point->id) }}" method="POST"
                                  onsubmit="return confirm('Supprimer ce point de présence ?')">
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
