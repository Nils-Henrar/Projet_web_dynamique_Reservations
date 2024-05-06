@extends('adminlte::page')

@section('title', 'Nouvelle Localité')

@section('content_header')
    <h1>Nouvelle Localité</h1>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('locality.store') }}" method="POST">
                @csrf

                <!-- Code postal -->
                <div class="mb-3">
                    <label for="postal_code" class="form-label">Code Postal</label>
                    <input type="text" 
                           name="postal_code" 
                           id="postal_code" 
                           class="form-control @error('postal_code') is-invalid @enderror" 
                           value="{{ old('postal_code') }}" 
                           required>
                    @error('postal_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nom de la localité -->
                <div class="mb-3">
                    <label for="locality" class="form-label">Localité</label>
                    <input type="text" 
                           name="locality" 
                           id="locality" 
                           class="form-control @error('locality') is-invalid @enderror" 
                           value="{{ old('locality') }}" 
                           required>
                    @error('locality')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Bouton de soumission -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
