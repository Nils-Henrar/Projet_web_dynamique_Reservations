@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Localité</h1>
@stop

@section ('content')
<div class="container mt-4">
<h2 class="text-2xl mt-2">Localités</h2>

<div class="row justify-content-end">
    <a href="{{ route('locality.create') }}" class="btn btn-primary">Ajouter une localité</a>
</div>

<div class="mt-4">
    <table class="table table-striped">  <!-- Tableau avec bandes alternées -->
        <thead>
            <tr>
                <th>Code Postal - Localité</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($localities as $locality)
            <tr>
                <!-- Lien vers la localité -->
                <td>
                    {{ $locality->postal_code }} - {{ $locality->locality }}
                </td>
                <td>
                    <div class="row">
                        <a href="{{ route('locality.show', $locality->id) }}" class="btn btn-primary mr-2">show</a>
                        <a href="{{ route('locality.edit', $locality->id) }}" class="btn btn-info mr-2">edit</a>
                        <form action="{{ route('locality.delete', ['id' => $locality->id]) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette représentation ?');">
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

</div>

@stop