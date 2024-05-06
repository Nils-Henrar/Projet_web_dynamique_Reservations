@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Représentations</h1>
@stop

@section ('content')
<div class="container">
<form action="{{ route('representation.update', ['id' => $representation->id]) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mt-2">
    <!-- Sélection du spectacle -->
    <select name="show_id" class="form-select @error('show_id') is-invalid @enderror">
        @foreach ($shows as $show)
            <option value="{{ $show->id }}" 
                    {{ old('show_id', $representation->show_id) == $show->id ? 'selected' : '' }}>
                {{ $show->title }}
            </option>
        @endforeach
    </select>
    </div>
    <div class="mt-2">
    <!-- Champ pour la localisation -->
    <select name="location_id" class="form-select @error('location_id') is-invalid @enderror">
        @foreach ($locations as $location)
            <option value="{{ $location->id }}" 
                    {{ old('location_id', $representation->location_id) == $location->id ? 'selected' : '' }}>
                {{ $location->designation }}
            </option>
        @endforeach
    </select>
    </div>
    
    <!-- Champ pour la date et l'heure -->
    <div class="mt-2">
    <input type="datetime-local" 
           name="schedule" 
           class="form-control @error('schedule') is-invalid @enderror"
           value="{{ old('schedule', $representation->schedule) }}">
    </div>

    <button type="submit" class="btn btn-primary mt-2">Mettre à jour</button>
</form>

</div>

@stop

@section('css')
@stop

@section('js')
@stop