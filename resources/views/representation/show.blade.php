@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Représentations</h1>
@stop

@section ('content')

<article>

    <h1 class="text-3xl mt-4"><strong>Representation du {{ $date }} à {{ $time }}</strong></h1>
    <p class="mt-4"><strong>Spectacle</strong> : {{ $representation->show->title }}</p>

    <p class="mt-4"><strong>Lieu :</strong>
        @if ($representation->location)
        {{ $representation->location->designation }}
        @elseif ($representation->show->location)
        {{ $representation->show->location->designation }}
        @else
        à déterminer
        @endif
    </p>

</article>

<nav class="mt-4"><a href="{{ route('representation.index') }}" class="btn btn-primary">Retour</a></nav>

@stop 

@section('css')
@stop

@section('js')
@stop