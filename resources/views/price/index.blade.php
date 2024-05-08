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
    <div class="row justify-content-end mb-5">
        <a href="{{ route('price.create') }}" class="btn btn-primary">Ajouter un prix</a>
    </div>



    <div class="row mt-4 justify-content-center">
        <div class="col-md-12">
    
        <div class="row mb-3">
            @if ($prices->isEmpty())
                <p class="text-center">Aucun résultat trouvé.</p>
            @else
            <table class="table table-striped border">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Type</th>
                        <th>Prix</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th class="col-md-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prices as $price)
                    <tr>
                        <td>{{ $price->id }}</td>
                        <td>{{ $price->type }}</td>
                        <td>{{ $price->price }}</td>
                        <td>{{ $price->start_date }}</td>
                        @if(empty($price->end_date))
                            <td>N/A</td>
                        @else
                            <td>{{ $price->end_date }}</td>
                        @endif

                        <td>
                            <div class="row">
                                <a href="{{ route('price.edit', $price->id) }}" class="btn btn-info mr-1">edit</a>
                                <form action="{{ route('price.delete', $price->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce prix ?');">
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
            @endif
    	    </div>
        </div>
    </div>
</div>

@stop
