@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Spectacles</strong></h1>
@stop

@section ('content')
<p>Liste de spectacles</p>
<div class="container mt-3">
    <div class="row justify-content-end mb-5">
        <a href="{{ route('show.create') }}" class="btn btn-primary">Ajouter un nouveau spectacle</a>
    </div>
    <div class="row">
        <table class="table table-striped border">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>reservable</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shows as $show)
                <tr>
                    <td><img src="{{ asset('images/'.$show->poster_url) }}" alt="{{ $show->title }}" width="40px"></td>
                    <td>{{ $show->title }}</td>
                    @if($show->bookable == 1)
                        <td>Oui</td>
                    @else
                        <td>Non</td>
                    @endif
                    <td>
                        <div class="row">
                            <a href="{{ route('admin.showid', $show->id) }}" class="btn btn-primary mr-1">show</a>
                                <a href="{{ route('show.edit', $show->id) }}" class="btn btn-info mr-1">edit</a>
                                <form action="{{ route('show.delete', ['id' => $show->id]) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce spectacle ?');">
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

@section('css')
@stop

@section('js')
@stop