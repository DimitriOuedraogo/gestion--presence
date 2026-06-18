@extends('layouts.admin')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')
@section('page-subtitle', 'Vue d\'ensemble de l\'activité')

@section('content')
@php redirect()->route('admin.dashboard')->send(); @endphp
@endsection
