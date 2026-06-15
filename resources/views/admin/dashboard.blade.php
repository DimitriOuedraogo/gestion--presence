@extends('layouts.admin')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-slate-500 text-sm">
            Employés
        </h3>
        <p class="text-3xl font-bold mt-2">
            120
        </p>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-slate-500 text-sm">
            Présences aujourd'hui
        </h3>
        <p class="text-3xl font-bold mt-2">
            98
        </p>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-slate-500 text-sm">
            Retards
        </h3>
        <p class="text-3xl font-bold mt-2">
            12
        </p>
    </div>

</div>

<div class="mt-6 bg-white rounded-xl shadow-sm p-6">

    <h3 class="font-semibold mb-4">
        Dernières présences
    </h3>

    <table class="w-full">

        <thead>
            <tr class="border-b">
                <th class="text-left py-3">Nom</th>
                <th class="text-left py-3">Date</th>
                <th class="text-left py-3">Statut</th>
            </tr>
        </thead>

        <tbody>
            <tr class="border-b">
                <td class="py-3">Jean Dupont</td>
                <td>12/06/2026</td>
                <td>
                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded">
                        Présent
                    </span>
                </td>
            </tr>
        </tbody>

    </table>

</div>

@endsection