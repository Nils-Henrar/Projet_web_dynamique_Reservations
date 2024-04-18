@extends ('layouts.main')

@section ('title', 'Liste des représentations')

@section ('content')

<h2 class="text-3xl mt-2">Listes des {{ $resource }}</h2>

<ul class="mt-4">
    @foreach ($representations as $representation)
    <li class="text-align:left mb-4 mt-4"><a href="{{ route('representation.show', $representation->id) }}" class="bg-pink-500 hover:bg-pink-700 text-white font-bold py-1 px-3 rounded mt-4 mb-4 mr-2">{{ $representation->show->title }}</a>
        @if ($representation->location)
        - <span> {{ $representation->location->designation }} </span>
        @endif
        - <datetime>{{ $representation->schedule }}</datetime>
    </li>
    @endforeach
</ul>

<div class="mt-12">
    <a href="{{ route('representation.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded mt-4 mb-4">Ajouter une représentation</a>
</div>

@endsection