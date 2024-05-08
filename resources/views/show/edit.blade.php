@extends('adminlte::page')

@section('content_header')
    <h1>Modifier Spectacle</h1>
@stop

@section('content')
<form action="{{ route('show.update', $show->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="title">Titre</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
               value="{{ old('title', $show->title) }}" required>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label pour="description">Description</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" required>
            {{ old('description', $show->description) }}
        </textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
    <label class="form-label">Associer des artistes existants</label>
    <div>
        @foreach ($artists as $artist)
            <div class="form-check">
                <input type="checkbox" 
                    name="artists[]" 
                    value="{{ $artist->id }}" 
                    id="artist{{ $artist->id }}" 
                    class="form-check-input"
                    @if(in_array($artist->id, old('artists', $selectedArtistIds)))
                        checked 
                    @endif
                >
                <label for="artist{{ $artist->id }}" class="form-check-label">
                    {{ $artist->firstname }} {{ $artist->lastname }}
                </label>
            </div>
        @endforeach
    </div>
</div>



    <button type="submit" class="btn btn-primary">Modifier</button>
    <a href="{{ route('show.index') }}" class="btn btn-secondary">Annuler</a>
</form>
@stop
