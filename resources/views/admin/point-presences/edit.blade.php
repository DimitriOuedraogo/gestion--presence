@extends('layouts.admin')

@section('title', 'Modifier un point de présence')
@section('page-title', 'Modifier un point de présence')


@section('content')

<div class="max-w-3xl mx-auto bg-white">

    <!-- <h1 class="text-xl font-bold mb-6">
        Nouveau point de présence
    </h1> -->

    <form
        action="{{ route('admin.point-presences.update', $pointPresence->id) }}"
        method="POST">
        @method('PUT')
        @include('admin.point-presences._form')

    </form>

</div>

@endsection