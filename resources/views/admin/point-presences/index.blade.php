@extends('layouts.admin')

@section('title', 'Points de présence')
@section('page-title', 'Points de présence')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>
        <h1 class="text-2xl font-bold">
            Points de présence
        </h1>
    </div>

    <a
        href="{{ route('admin.point-presences.create') }}"
        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        Nouveau point
    </a>

</div>

<div class="bg-white rounded-xl shadow overflow-hidden">

    <table class="w-full">

        <thead class="bg-gray-100">
            <tr>
                <th class="p-4 text-left">Nom</th>
                <th class="p-4 text-left">Latitude</th>
                <th class="p-4 text-left">Longitude</th>
                <th class="p-4 text-left">Rayon</th>
                <th class="p-4 text-left">Actions</th>
            </tr>
        </thead>

        <tbody>

            @forelse($pointPresences as $point)

            <tr class="border-t">

                <td class="p-4">
                    {{ $point->nom }}
                </td>

                <td class="p-4">
                    {{ $point->latitude }}
                </td>

                <td class="p-4">
                    {{ $point->longitude }}
                </td>

                <td class="p-4">
                    {{ $point->rayon_autorise }} m
                </td>

                <td class="p-4 flex gap-2">

                    <a
                        href="{{ route('admin.point-presences.edit', $point->id) }}"
                        class="text-blue-600">
                        Modifier
                    </a>

                    <form
                        action="{{ route('admin.point-presences.destroy', $point->id) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="text-red-600">
                            Supprimer
                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>
                <td colspan="5" class="p-6 text-center">
                    Aucun point trouvé.
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

</div>

<div class="mt-4">
    {{ 'points présences'}}
</div>

@endsection