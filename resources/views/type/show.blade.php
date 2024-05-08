@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section ('content')

<h1 class="text-2xl mt-4">Type : {{ $type->type }}</h1>


<h2 class="text-2xl mt-4">Liste des artistes</h2>

<ul class="mt-4">
    @foreach ($type->artists as $artist)
    <li class="list-disc ml-8">
        {{$artist->firstname}} {{$artist->lastname}}
    </li>
    @endforeach
</ul>

<div class="mt-4">
    <a href="{{ route('type.index') }}" class="btn btn-primary">Back</a>
</div>

@stop