@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Localité</h1>
@stop

@section ('content')

<h1 class="text-2xl mt-4">Localité : {{ $locality->postal_code }} - {{ $locality->locality }}</h1>

<ul class="mt-4">
    @foreach ($locality->locations as $location)
    <li class="list-disc ml-8">
        {{$location->designation}}
    </li>
    @endforeach
</ul>

<div class="mt-4">
    <a href="{{ route('locality.index') }}" class="btn btn-primary">Retour</a>
</div>

@stop