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
        <form method="POST" action="{{ route('price.store') }}">
            @csrf

            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <input type="text" class="form-control" id="type" name="type" required value="{{ old('type') }}"> <!-- Utiliser old() -->
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" min="0" step="1" required value="{{ old('price') }}">
            </div>

            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required value="{{ old('start_date') }}">
            </div>

            <div class="mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date"  required value="{{ old('end_date') }}">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
 @stop