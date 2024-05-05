@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Edit artist</h1>
@stop

@section('content')

<div class="row">
    <h1 class="text-3xl mt-4"><strong>{{ $artist->firstname }} {{ $artist->lastname }}</strong></h1>
</div>
<div class="row">
    <h2 class="text-xl mt-4">Compétences</h2>
</div>
<div class="row">
  <table class="table table-striped mt-2 mb-5 col-4">
    <thead>
        <tr>
            <th>Type</th>  <!-- En-tête de colonne -->
        </tr>
    </thead>
    <tbody>
        @foreach ($artist->types as $type)
        <tr>
            <td>{{ $type->type }}</td>  <!-- Affichage du type -->
        </tr>
        @endforeach
    </tbody>
    </table>
</div>


<div class="row">
    <a href="{{ route('artist.index') }}" class="btn btn-primary">Retour</a>
    <a href="{{ route('artist.edit', $artist->id) }}" class="btn btn-info ml-2">Modifier</a>
    <form action="{{ route('artist.delete', $artist->id) }}" method="POST" class="mr-2">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger ml-2">Supprimer</button>
    </form>
</div>

@stop

@section('css')
@stop

@section('js')
@stop