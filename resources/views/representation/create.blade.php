@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Représentations</h1>
@stop

@section ('content')
<div class="container">
<form action="{{ route('representation.store') }}" method="POST">
    @csrf

    <!-- Sélection du show -->
    <div class="mb-3">
        <label for="show_id" class="form-label">Spectacle</label>
        <select id="show_id" name="show_id" class="form-select @error('show_id') is-invalid @enderror" required>
            <option value="">Choisissez un spectacle</option>  <!-- Option par défaut -->
            @foreach ($shows as $show)
                <option value="{{ $show->id }}" {{ old('show_id') == $show->id ? 'selected' : '' }}>
                    {{ $show->title }}
                </option>
            @endforeach
        </select>
        @error('show_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Sélection de la localisation (facultatif) -->
    <div class="mb-3">
        <label for="location_id" class="form-label">Lieu</label>
        <select id="location_id" name="location_id" class="form-select @error('location_id') is-invalid @enderror">
            <option value="">Sélectionnez un lieu (facultatif)</option>
            @foreach ($locations as $location)
                <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                    {{ $location->designation }}
                </option>
            @endforeach
        </select>
        @error('location_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Sélection de la date et de l'heure -->
    <div class="mb-3">
        <label for="schedule" class="form-label">Date et heure</label>
        <input type="datetime-local" 
               id="schedule" 
               name="schedule" 
               class="form-control @error('schedule') is-invalid @enderror" 
               value="{{ old('schedule') }}">  <!-- Permet d'utiliser 'old()' pour conserver les valeurs précédentes -->
        @error('schedule')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Bouton de soumission -->
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Créer la représentation</button>
    </div>
</form>


</div>

@stop

@section('css')
@stop

@section('js')
@stop