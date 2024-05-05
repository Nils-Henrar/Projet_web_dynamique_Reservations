@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Représentations</h1>
@stop

@section ('content')
<div class="container">
    <h2 class="text-3xl mt-2">Listes des {{ $resource }}</h2>
    <div class="row justify-content-end">
        <a href="{{ route('representation.create') }}" class="btn btn-primary">Ajouter une représentation</a>
    </div>
    <table class="table table-striped mt-4">
    <thead>
        <tr>
            <th>Spectacle</th>
            <th>Lieu</th>
            <th>Date et Heure</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($representations as $representation)
        <tr>
            <!-- Lien vers le spectacle -->
            <td>
                {{ $representation->show->title }}
            </td>

            <!-- Lieu de la représentation -->
            <td>
                @if ($representation->location)
                    {{ $representation->location->designation }}
                @else
                    N/A
                @endif
            </td>

            <!-- Date et Heure de la représentation -->
            <td>
                {{ $representation->schedule }}
            </td>
            <td>
                <a href="{{ route('representation.show', $representation->id) }}" class="btn btn-primary">show</a>
                <a href="" class="btn btn-info">edit</a>
                <a href="" class="btn btn-danger">delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>

@stop

@section('css')
@stop

@section('js')
@stop