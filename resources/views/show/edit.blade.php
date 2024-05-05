@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Modifier spectacle</strong></h1>
@stop

@section('content')


<form action="" method="post">
    @csrf
    @method('PUT')
    <div>
        <label for="firstname">Titre du spectacle</label>
        <input type="text" id="title" name="title" 
       @if(old('title'))
            value="{{ old('title') }}" 
        @else
            value="{{ $show->title }}" 
        @endif
           class="@error('title') is-invalid @enderror">

@error('title')
        <div class="alert alert-danger">{{ $message }}</div>
 @enderror
    </div>

    <div>
        <label for="description">Description</label>
        <textarea id="description" 
              name="description" 
              class="form-control @error('description') is-invalid @enderror" 
              rows="3" 
              required>{{ old('description', $show->description) }}</textarea>

            @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
            @enderror
                </div>
                <label class="form-label">Associer des artistes existants</label>


    

    <button class="btn btn-primary">Modifier</button>
<a href="{{ route('admin.showid',$show->id) }}" class= "btn btn-success">Annuler</a>
</form>

@if ($errors->any())
<div class="alert alert-danger">
   <h2>Liste des erreurs de validation</h2>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<nav><a href="{{ route('artist.index') }}">Retour à l'index</a></nav>

@stop

@section('css')
@stop

@section('js')
@stop