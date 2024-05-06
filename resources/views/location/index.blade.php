@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Représentations</h1>
@stop

@section ('content')
<div class="container">
<h2 class="text-3xl mt-2">Lieux de représentation</h2>
<div class="row mt-4 justify-content-end">
    <a href="{{ route('location.create') }}" class="btn btn-primary">Ajouter un lieu</a>
</div>

<table class="table table-striped mt-4">  <!-- Tableau avec bandes alternées -->
    <thead>
        <tr>
            <th>Lieu</th>
            <th>Adresse</th>
            <th>Localité</th>
            <th>Site Web</th>
            <th>Téléphone</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($locations as $location)
        <tr>
            <!-- Nom du lieu avec un lien -->
            <td>
                {{ $location->designation }}
            </td>

            <!-- Adresse -->
            <td>
                {{ $location->address }}
            </td>

            <!-- Code postal et localité -->
            <td>
                {{ $location->locality->postal_code }} {{ $location->locality->locality }}
            </td>

            <!-- Lien vers le site web, s'il existe -->
            <td>
                @if ($location->website)
                    <a href="{{ $location->website }}" 
                       class="text-blue-500 hover:text-blue-700 visited:text-purple-500">
                       {{ $location->website }}
                    </a>
                @else
                    N/A
                @endif
            </td>

            <!-- Numéro de téléphone -->
            <td>
                {{ $location->phone ?? 'N/A' }}
            </td>
            <td>
                <div class="row">
                    <a href="{{ route('location.show', $location->id) }}" class="btn btn-primary">show</a>
                    <a href="{{ route('location.edit', $location->id) }}" class="btn btn-info">edit</a>
                    <form action="{{ route('location.delete', ['id' => $location->id]) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette représentation ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">delete</button>
                    </form>
                </div>
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