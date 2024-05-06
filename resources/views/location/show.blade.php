@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Locations</h1>
@stop

@section ('content')

<h1 class="text-3xl mt-4">{{ $location->designation }}</h1>

<ul class="mt-4">
    <li>
        {{ $location->address }},
    </li>
    <li>
        {{ $location->locality->postal_code }} {{ $location->locality->locality }}
    </li>
    @if ($location->website)
    <li>
        <a href="{{ $location->website }}" class="text-blue-500 hover:text-blue-700 visited:text-purple-500">{{ $location->website }}</a>
    </li>
    @endif

    @if ($location->phone)
    <li>
        {{ $location->phone }}
    </li>
    @endif
</ul>


<h2 class="text-2xl mt-4">Liste des spectacles</h2>

<ul class="mt-4">
    @foreach ($location->shows as $show)
    <li class="list-disc ml-8">
        <a href="{{ route('show.show', $show->id) }}">{{ $show->title }}</a>
    </li>
    @endforeach

</ul>

<div class="mt-4">
    <a href="{{ route('location.index') }}" class="btn btn-primary">Retour</a>
    <a href="{{ route('location.edit', $location->id) }}" class="btn btn-info">Modifier</a>
</div>

@stop

@section('css')
@stop

@section('js')
@stop