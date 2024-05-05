@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section ('content')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <img src="{{ asset('images/'.$show->poster_url) }}" alt="{{ $show->title }}" class="" width="100%">
        </div>
        <div class="col-md-6 ml-3">
            <div class="row">
                <h2><strong>{{ $show->title }}</strong></h2>
            </div>
            <div class="row mt-2">
                <p>{{ $show->description }}</p>
            </div>
            <div class="row">
                <p class="mt-4">
                    <strong>De
                        @foreach ($show->auteurs as $auteur)
                        {{ $auteur->firstname }} {{ $auteur->lastname }}
                        @if ($loop->iteration == $loop->count - 1)
                        et
                        @elseif (!$loop->last)
                        ,
                        @endif
                        @endforeach
                    </strong>
                </p>

            </div>
            <div class="row">
                <h4><strong>Liste des représentations</strong></h4>
                @if ($show->representations->count() >= 1)

                <table class="table table-striped border mt-2">
                    <thead>
                        <tr>
                            <th class="text-left">Date</th>
                            <th class="text-left">Heure</th>
                            <th class="text-left">Lieu</th>
                        </tr>
                    <tbody>
                        @foreach ($show->representations as $representation)

                        <tr>
                            <td>{{ $representation->schedule->format('l d F Y') }}</td>
                            <td>{{ $representation->schedule->format('H:i') }}</td>
                            <td>
                                @if ($representation->location)
                                    {{ $representation->location->designation }}
                                @elseif ($representation->show->location)
                                    {{ $representation->show->location->designation }}
                                @else
                                    à déterminer
                                @endif
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="mt-4">Pas de représentation pour le moment</p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Contact</strong></p>
            @if ($show->location)
            <p>{{ $show->location->designation }}</p>
            <p>{{ $show->location->phone }}</p>
            @endif
        </div>
        <div class="col-md-6">
            <div class="mt-5">
                <a href="{{ route('show.edit', $show->id) }}" class="btn btn-info">edit</a>
                <a href="{{ route('show.delete', $show->id) }}" class="btn btn-danger ml-5">delete</a>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
@stop

@section('js')
@stop