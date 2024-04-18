@extends ('layouts.main')

@section ('title', 'Fiche d\'une représentation')

@section ('content')

<article>

    <h1 class="text-3xl mt-4"><strong>Representation du {{ $date }} à {{ $time }}</strong></h1>
    <p class="mt-4"><strong>Spectacle</strong> : {{ $representation->show->title }}</p>

    <p class="mt-4"><strong>Lieu :</strong>
        @if ($representation->location)
        {{ $representation->location->designation }}
        @elseif ($representation->show->location)
        {{ $representation->show->location->designation }}
        @else
        à déterminer
        @endif
    </p>

</article>

<nav class="mt-4"><a href="{{ route('representation.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline">Retour</a></nav>

@endsection