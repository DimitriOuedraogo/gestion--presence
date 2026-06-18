@extends('layouts.admin')

@section('title', 'Créer une session')
@section('page-title', 'Créer une session')

@section('content')
<div class="max-w-3xl mx-auto">

    <form action="{{ route('admin.session-presences.update', $sessionPresence->id )}}" method="POST">
        @include('admin.session-presences._form')
    </form>

</div>
@endsection