@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section ('content')

<div class="container">

    <div class="row">
        <p>Gestion des artistes.</p>
    </div>
    <div class="row justify-content-end mb-5">
        <a href="{{ route('artist.create') }}" class="btn btn-primary">Ajouter un nouvel artiste</a>
    </div>



    <div class="row mt-4 justify-content-center">
        <div class="col-md-12">
        <div class="row mb-4">
            <div class="col-md-5">
                <!-- Formulaire de recherche -->
                <form method="GET" action="{{ route('artist.index') }}" class="form-inline">
                    <input type="text" name="search" placeholder="Rechercher un artiste..." class="form-control mr-2" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </form>
            </div>
            <div class="col-md-3">
                <form method="GET" action="{{ route('artist.index') }}" class="form-inline">
                    <!-- <label for="order">Trier par: </label> -->
                    <select name="order" class="form-control ml-2" onchange="this.form.submit()">
                        <option value="" disabled selected>Choisir un critère de tri</option>
                        <option value="firstname_asc" {{ request('order') == 'firstname_asc' ? 'selected' : '' }}>Prénom (A-Z)</option>
                        <option value="firstname_desc" {{ request('order') == 'firstname_desc' ? 'selected' : '' }}>Prénom (Z-A)</option>
                        <option value="lastname_asc" {{ request('order') == 'lastname_asc' ? 'selected' : '' }}>Nom (A-Z)</option>
                        <option value="lastname_desc" {{ request('order') == 'lastname_desc' ? 'selected' : '' }}>Nom (Z-A)</option>
                    </select>
                </form>
            </div>
            <div class="col-md-3">
                <a href="{{ route('artist.index') }}" class="btn btn-primary">réinitialiser</a>
            </div>
        </div>
        <div class="row mb-3">
            @if ($artists->isEmpty())
                <p class="text-center">Aucun résultat trouvé.</p>
            @else
            <table class="table table-striped border">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th class="col-md-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($artists as $artist)
                    <tr>
                        <td>{{ $artist->id }}</td>
                        <td>{{ $artist->firstname }}</td>
                        <td>{{ $artist->lastname }}</td>
                        <td>
                            <div class="row">
                                <a href="{{ route('admin.showartist', $artist->id ) }}" class="btn btn-primary mr-1">show</a>
                                <a href="{{ route('artist.edit', $artist->id ) }}" class="btn btn-info mr-1">edit</a>
                                <form action="{{ route('artist.delete', ['id' => $artist->id]) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet artiste ?');">
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

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop