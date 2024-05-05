@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Edit artist</h1>
@stop

@section ('content')

<h1 class="text-2xl">Edit artist</h1>
<div class= col-md-4>
<!-- Formulaire de modification d'un artiste -->
<form action="{{ route('artist.update', $artist->id) }}" method="POST" class="mt-4">
    @csrf

    <!-- Champ Prénom -->
    <div class="mb-4">
        <label for="firstname" class="form-label">Prénom</label>
        <input type="text" name="firstname" id="firstname" 
               class="form-control @error('firstname') is-invalid @enderror"
               value="{{ old('firstname', $artist->firstname) }}">
        @error('firstname')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Champ Nom -->
    <div class="mb-4">
        <label for="lastname" class="form-label">Nom</label>
        <input type="text" name="lastname" id="lastname" 
               class="form-control @error('lastname') is-invalid @enderror"
               value="{{ old('lastname', $artist->lastname) }}">
        @error('lastname')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Champ Compétences -->
    <div class="mb-4">
        <label class="form-label">Compétences</label>
        @foreach($types as $type)
            <div class="form-check">
                <input type="checkbox" 
                       name="types[]" 
                       value="{{ $type->id }}" 
                       class="form-check-input"
                       id="type{{ $type->id }}"
                       @if($artist->types->contains($type)) checked @endif>
                <label for="type{{ $type->id }}" class="form-check-label">{{ $type->type }}</label>
            </div>
        @endforeach
        @error('types')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Boutons d'action -->
    <div class="d-flex justify-content-between">
        <a href="{{ route('artist.index') }}" class="btn btn-secondary">Retour</a>
        <button type="submit" class="btn btn-success">Modifier</button>
    </div>
</form>
</div>


@if ($errors->any())
<div class="alert alert-danger mt-4">
    <h2>Listes des erreurs de validation</h2>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@stop

@section('css')
@stop

@section('js')
@stop