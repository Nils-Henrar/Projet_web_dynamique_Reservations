@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Create artist</h1>
@stop

@section ('content')
<div class="container">
<h1 class="text-3xl"><strong>Ajouter un artiste</strong></h1>
        <div class="row justify-content-end">
            <a href="{{ route('artist.index') }}" class="btn btn-primary">Retour à la liste</a>
        </div>
 
        <form action="{{ route('artist.store') }}" method="POST" class="mt-4 col-md-12">
        @csrf
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="row mt-2">
                    <div class="mb-4">
                        <div>
                            <label for="firstname" class="block text-gray-700 text-lg font-bold mb-2">Prénom</label>
                        </div>
                        <div>
                            <input type="text" name="firstname" id="firstname" @if(old('firstname')) value="{{ old('firstname') }}" @endif class="@error('firstname') is-invalid @enderror shadow appearance-none border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        @error('firstname')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class=" mb-4">
                        <div>
                            <label for="lastname" class="block text-gray-700 text-lg font-bold mb-2">Nom</label>
                        </div>
                        <div>
                            <input type="text" name="lastname" id="lastname" @if(old('lastname')) value="{{ old('lastname') }}" @endif class="@error('lastname') is-invalid @enderror shadow appearance-none border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        @error('lastname')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-5">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </div>
            <div class="col-md-7 mb-4">
            <div class="mt-3">
                <label class="block text-gray-700 text-md font-bold mb-3">Compétences</label>
                <div class="row">
                    @foreach($types as $type)
                    <div style="width:250px;">
                        <input type="checkbox" name="types[]" value="{{ $type->id }}" id="type{{ $type->id }}" class="ml-3">
                        <label for="type{{ $type->id }}">{{ $type->type }}</label>
                    </div>
                    @endforeach
                    @error('types')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        </div>
        <div class="flex items-center justify-between">
            <a href="{{ route('artist.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline">Retour</a>
            <!-- <button type="submit" class="bg-pink-500 hover:bg-green-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline">Ajouter</button> -->
            
        </div>
        </form>



        @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <h2>Listes des erreurs de validation</h2>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

        @endif
</div>
@stop

@section('css')
@stop

@section('js')
@stop