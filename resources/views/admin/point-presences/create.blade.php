@extends('layouts.admin')

@section('title', 'Créer un point de présence')
@section('page-title', 'Créer un point de présence')


@section('content')

<div class="max-w-3xl mx-auto bg-white">

    <!-- <h1 class="text-xl font-bold mb-6">
        Nouveau point de présence
    </h1> -->

    <form
        action="{{ route('admin.point-presences.store') }}"
        method="POST">
        @include('admin.point-presences._form')

    </form>

</div>

@endsection