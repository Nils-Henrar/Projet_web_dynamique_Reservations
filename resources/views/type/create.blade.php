@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section ('content')

<h1 class="text-2xl">Créer un nouveau type</h1>

<form action="{{ route('type.store') }}" method="POST" class="mt-4">
    @csrf

    <!-- Champ pour le type -->
    <div class="mb-4">
        <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Type</label>
        <input type="text" 
               name="type" 
               id="type" 
               value="{{ old('type') }}"  
               class="@error('type') is-invalid @enderror shadow appearance-none border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

        @error('type')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Boutons d'action -->
    <div class="flex items-center justify-between">
        <a href="{{ route('type.index') }}" class="btn btn-info">Retour</a>
        <button type="submit" class="btn btn-primary">Créer</button>
    </div>

    <!-- Affichage des erreurs de validation -->
    @if ($errors->any())
    <div class="alert alert-danger mt-4">
        <h2>Liste des erreurs de validation</h2>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

</form>

@stop
