@extends('layouts.admin')

@section('title', 'Agents')
@section('page-title', 'Agents')
@section('page-subtitle', 'Liste de tous les agents enregistrés')

@section('content')

<div class="flex items-center justify-between mb-5">
    <div>
        <h2 class="text-xl font-bold text-slate-800">Agents</h2>
        <p class="text-slate-500 text-sm mt-0.5">{{ $agents->total() }} agent(s) enregistré(s)</p>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">

    <div class="px-6 py-4 border-b border-slate-100">
        <h3 class="font-semibold text-slate-700 text-sm">Liste des agents</h3>
    </div>

    @if ($agents->isEmpty())
    <div class="py-16 text-center">
        <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <h3 class="text-base font-semibold text-slate-700">Aucun agent</h3>
        <p class="text-slate-400 text-sm mt-1">Aucun agent n'est enregistré pour le moment.</p>
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
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Structure</th>
                    <th class="px-6 py-3.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Statut</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach ($agents as $agent)
                <tr class="hover:bg-slate-50 transition-colors">

                    <td class="px-6 py-4 text-sm text-slate-400">
                        {{ ($agents->currentPage() - 1) * $agents->perPage() + $loop->iteration }}
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                                <span class="text-sm font-semibold text-blue-600">
                                    {{ strtoupper(substr($agent->prenom, 0, 1)) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-800">{{ $agent->prenom }} {{ $agent->nom }}</p>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-4 text-sm text-slate-500">
                        {{ $agent->email }}
                    </td>

                    <td class="px-6 py-4">
                        @if($agent->telephone)
                            <span class="text-sm font-medium text-slate-700">{{ $agent->telephone }}</span>
                        @else
                            <span class="text-sm text-slate-300">—</span>
                        @endif
                    </td>

                    <td class="px-6 py-4 text-sm text-slate-500">
                        {{ $agent->structure ?? '—' }}
                    </td>

                    <td class="px-6 py-4 text-center">
                        @if($agent->actif)
                            <span class="inline-flex items-center gap-1.5 text-xs font-medium text-green-700 bg-green-50 border border-green-200 px-2.5 py-1 rounded-full">
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                Actif
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-500 bg-slate-100 border border-slate-200 px-2.5 py-1 rounded-full">
                                <span class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span>
                                Inactif
                            </span>
                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($agents->hasPages())
    <div class="px-6 py-4 border-t border-slate-100">
        {{ $agents->links() }}
    </div>
    @endif

    @endif

</div>

@endsection
