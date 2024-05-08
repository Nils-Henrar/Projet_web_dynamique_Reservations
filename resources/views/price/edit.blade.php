@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Price</h1>
@stop

@section ('content')

<div class="container">

    <div class="row">
        <p>Gestion des prix.</p>
    </div>
    <div class="row">
    <form method="POST" action="{{ route('price.update', $price->id) }}">
    @csrf
    @method('PUT') <!-- Utilisation de PUT pour mettre à jour -->

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <input type="text" class="form-control" id="type" name="type" value="{{ old('type', $price->type) }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" min="0" step="0.01" value="{{ old('price', $price->price) }}" required>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $price->start_date) }}" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $price->end_date) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    </div>
</div>
 @stop