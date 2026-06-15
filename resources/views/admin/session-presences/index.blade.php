@extends('layouts.admin')

@section('title', 'Sessions')
@section('page-title', 'Sessions')

@section('content')

<div class="flex items-center justify-between mb-6">

    <div>
        <h1 class="text-2xl font-bold text-slate-800">
            Sessions
        </h1>

        <p class="text-slate-500 mt-1">
            Gérez les sessions de présence.
        </p>
    </div>

    <a
        href="{{ route('admin.session-presences.create') }}"
        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition shadow-sm">
        <span class="mr-2">+</span>
        Nouvelle session
    </a>

</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

    <div class="px-6 py-4 border-b border-slate-200">
        <h2 class="font-semibold text-slate-700">
            Liste des sessions
        </h2>
    </div>

    @if ($sessions->isEmpty())

    <div class="py-16 text-center">

        <div class="text-5xl mb-4">

        </div>

        <h3 class="text-lg font-medium text-slate-700">
            Aucune session disponible
        </h3>

        <p class="text-slate-500 mt-2">
            Commencez par créer une nouvelle session.
        </p>

    </div>

    @else

    <div class="overflow-x-auto">

        <table class="min-w-full divide-y divide-slate-200">

            <thead class="bg-slate-50">

                <tr>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Nom
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Lieu
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Début
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Fin
                    </th>

                    <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Actions
                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-slate-100 bg-white">

                @foreach ($sessions as $session)

                <tr class="hover:bg-slate-50 transition">

                    <td class="px-6 py-4">

                        <div class="font-medium text-slate-800">
                            {{ $session->nom }}
                        </div>

                    </td>

                    <td class="px-6 py-4 text-slate-600">
                        {{ $session->pointPresence->nom ?? 'N/A' }}
                    </td>

                    <td class="px-6 py-4 text-slate-600">
                        {{ $session->datePresenceFormatee }} {{ $session->heureDebutFormatee }}
                    </td>

                    <td class="px-6 py-4 text-slate-600">
                        {{ $session->datePresenceFormatee }} {{ $session->heureFinFormatee }}
                    </td>

                    <td class="px-6 py-4">

                        <div class="flex justify-center items-center gap-4">

                            <a
                                href="{{ route('admin.session-presences.edit', $session->id) }}"
                                class="text-blue-600 hover:text-blue-800 font-medium">
                                Modifier
                            </a>

                            <form
                                action="{{ route('admin.session-presences.destroy', $session->id) }}"
                                method="POST"
                                onsubmit="return confirm('Voulez-vous vraiment supprimer cette session ?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="text-red-600 hover:text-red-800 font-medium">
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