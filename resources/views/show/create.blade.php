@extends('layouts.main')

@section('title', 'Ajouter un nouveau spectacle')

@section('content')
<form action="{{ route('show.store') }}" method="POST">
    @csrf

    <div>
        <label for="title">Titre du spectacle</label>
        <input type="text" id="title" name="title" required>
    </div>

    <div>
        <label for="description">Description</label>
        <textarea id="description" name="description" required></textarea>
    </div>

    {{-- Ajoutez d'autres champs nécessaires pour un spectacle ici --}}

    {{-- Section pour associer des artistes existants --}}
    <div>
        <label for="existing_artists">Associer des artistes existants</label>
        <select id="existing_artists" name="artists[]" multiple>
            @foreach ($artists as $artist)
            <option value="{{ $artist->id }}">{{ $artist->firstname }} {{ $artist->lastname }}</option>
            @endforeach
        </select>
    </div>

    <!-- {{-- Section pour ajouter un nouvel artiste --}} -->
    <div>
        <label for="new_artist_firstname">Prénom de l'artiste</label>
        <input type="text" id="new_artist_firstname" name="new_artist_firstname">
    </div>
    <div>
        <label for="new_artist_lastname">Nom de l'artiste</label>
        <input type="text" id="new_artist_lastname" name="new_artist_lastname">
    </div>

    {{-- Vous pouvez ajouter des champs pour d'autres attributs de l'artiste ici --}}

    <button type="submit">Créer le spectacle</button>
</form>
@endsection