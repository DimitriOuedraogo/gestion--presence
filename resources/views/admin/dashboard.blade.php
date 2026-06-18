@extends('layouts.admin')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <!-- Grille des indicateurs (KPIs) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Carte : Employés -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-100 flex items-center justify-between">
            <div class="space-y-1">
                <h3 class="text-slate-500 text-xs font-semibold uppercase tracking-wider">
                    Total Employés
                </h3>
                <p class="text-3xl font-bold text-slate-900 tracking-tight">
                    120
                </p>
            </div>
            <div class="p-3 bg-slate-50 rounded-xl text-slate-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
        </div>

        <!-- Carte : Présences -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-100 flex items-center justify-between">
            <div class="space-y-1">
                <h3 class="text-slate-500 text-xs font-semibold uppercase tracking-wider">
                    Présences aujourd'hui
                </h3>
                <p class="text-3xl font-bold text-emerald-600 tracking-tight">
                    98
                </p>
            </div>
            <div class="p-3 bg-emerald-50 rounded-xl text-emerald-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <!-- Carte : Retards -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-100 flex items-center justify-between">
            <div class="space-y-1">
                <h3 class="text-slate-500 text-xs font-semibold uppercase tracking-wider">
                    Retards constatés
                </h3>
                <p class="text-3xl font-bold text-rose-600 tracking-tight">
                    12
                </p>
            </div>
            <div class="p-3 bg-rose-50 rounded-xl text-rose-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

    </div>

    <!-- Section : Dernières Activités / Tableau -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">

        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-900 tracking-tight text-base">
                Derniers émargements enregistrés
            </h3>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                Flux temps réel
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm divide-y divide-slate-100">
                <thead class="bg-slate-50 text-slate-500 font-medium uppercase tracking-wider text-xs">
                    <tr>
                        <th class="px-6 py-4 text-left">Collaborateur</th>
                        <th class="px-6 py-4 text-left">Date & Heure</th>
                        <th class="px-6 py-4 text-left">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700 bg-white">
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap font-semibold text-slate-900">
                            Jean Dupont
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-slate-500">
                            12/06/2026 à 08:14
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                                Présent
                            </span>
                        </td>
                    </tr>
                    <!-- Exemple de ligne en retard pour prévisualiser le rendu -->
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap font-semibold text-slate-900">
                            Alice Martin
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-slate-500">
                            12/06/2026 à 09:45
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-100">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-rose-500 rounded-full"></span>
                                Retard
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection