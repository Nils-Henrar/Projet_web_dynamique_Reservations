@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section ('content')
<div class="container">
<h2 class="text-2xl mt-2">Types</h2>

<div class="row justify-content-end">
    <a href="{{ route('type.create') }}" class="btn btn-primary">Ajouter un type d'artiste</a>
</div>

<div class="mt-4">
    <table class="table table-striped">  <!-- Tableau avec bandes alternées -->
        <thead>
            <tr>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
            <tr>
                <!-- Lien vers le type -->
                <td>
                    {{ $type->type }}
                </td>
                <td>
                    <div class="row">
                        <a href="{{ route('type.show', $type->id) }}" class="btn btn-primary mr-2">show</a>
                        <a href="{{ route('type.edit', $type->id) }}" class="btn btn-info mr-2">edit</a>
                        <form action="{{ route('type.delete', $type->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette représentation ?');">
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