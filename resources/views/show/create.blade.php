@extends('adminlte::page')

@section('title', 'Créer un Spectacle')

@section('content_header')
    <h1><strong>Créer un Nouveau Spectacle</strong></h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('show.store') }}" method="POST" class="p-3">
        @csrf

        <!-- Titre du spectacle -->
        <div class="mb-3">
            <label for="title" class="form-label">Titre du Spectacle</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>

        <!-- Description du spectacle -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control" rows="3" required></textarea>
        </div>

        <!-- URL de l'affiche -->
        <div class="mb-3">
            <label for="poster_url" class="form-label">URL de l'Affiche</label>
            <input type="text" id="poster_url" name="poster_url" class="form-control">
        </div>

        <div class="mb-3">
            <label pour="created_in" class="form-label">Créé à</label>
            <input type="text" id="created_in" name="created_in" class="form-control" required> <!-- Champ créé à -->
        </div>

        <!-- Durée du spectacle -->
        <div class="mb-3">
            <label for="duration" class="form-label">Durée du Spectacle (minutes)</label>
            <input type="number" id="duration" name="duration" class="form-control" min="1" required>
        </div>

        <!-- Liste des artistes existants -->
        <div class="mb-3">
            <label class="form-label">Associer des Artistes Existants</label>
            <div>
                @foreach ($artists as $artist)
                    <div class="form-check">
                        <input type="checkbox" 
                            name="artists[]" 
                            value="{{ $artist->id }}" 
                            id="artist{{ $artist->id }}" 
                            class="form-check-input">
                        <label pour="artist{{ $artist->id }}" class="form-check-label">
                            {{ $artist->firstname }} {{ $artist->lastname }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Bouton de soumission -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Créer le Spectacle</button>
        </div>
    </form>
</div>
@stop

@section('css')
@stop

@section('js')
@stop
