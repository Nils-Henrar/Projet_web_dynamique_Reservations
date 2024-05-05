@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Nouveau spectacle</strong></h1>
@stop

@section('content')
<div class="container">


<div class="row">
    <div class="col-md-5">
        <form action="{{ route('show.store') }}" method="POST" class="p-3">
            @csrf

            <!-- Titre du spectacle -->
            <div class="mb-3">
                <label for="title" class="form-label">Titre du spectacle</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>

            <!-- Description du spectacle -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3" required></textarea>
            </div>

            <!-- Liste des artistes existants -->
            <div class="mb-3">
                <label class="form-label">Associer des artistes existants</label>
                <div>
                    @foreach ($artists as $artist)
                        <div class="form-check">
                            <input type="checkbox" 
                                name="artists[]" 
                                value="{{ $artist->id }}" 
                                id="artist{{ $artist->id }}" 
                                class="form-check-input">
                            <label for="artist{{ $artist->id }}" class="form-check-label">
                                {{ $artist->firstname }} {{ $artist->lastname }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Section pour ajouter un nouvel artiste -->
            <div class="mb-3">
                <label for="new_artist_firstname" class="form-label">Prénom du nouvel artiste</label>
                <input type="text" id="new_artist_firstname" name="new_artist_firstname" class="form-control">
            </div>
            <div class="mb-3">
                <label for="new_artist_lastname" class="form-label">Nom du nouvel artiste</label>
                <input type="text" id="new_artist_lastname" name="new_artist_lastname" class="form-control">
            </div>

            <!-- Bouton de soumission -->
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Créer le spectacle</button>
            </div>
        </form>
</div>

</div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop