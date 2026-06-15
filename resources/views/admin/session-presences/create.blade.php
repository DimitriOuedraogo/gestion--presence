@extends('layouts.admin')

@section('title', 'Sessions')
@section('page-title', 'Sessions')

@section('content')
<div class="max-w-3xl mx-auto bg-white">

    <!-- <h1 class="text-xl font-bold mb-6">
        Nouvelle session
    </h1> -->

    <form
        action="{{ route('admin.session-presences.store') }}"
        method="POST">
        @include('admin.session-presences._form')

    </form>

</div>

@endsection