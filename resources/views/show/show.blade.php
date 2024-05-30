@extends ('layouts.main')

@section ('title', 'Fiche d\'une représentation')

@section ('content')


<article>

    <h1 class="text-3xl mt-4"><strong>{{ $show->title }}</strong></h1>

    @if ($show->location)
    <p class="mt-2 mb-4"> {{ $show->location->designation }} - {{ $show->location->address }} {{ $show->location->locality->postal_code }} {{ $show->location->locality->locality }}</p>
    @endif


    <div class="flex items-start">
        <div class="flex-shrink-0">
            @if ($show->poster_url)
            <img src="{{ asset('images/'.$show->poster_url) }}" alt="{{ $show->title }}" class="w-60 h-auto">
            @endif
        </div>

        <div class="ml-4">

            <p class="mt-4 md:w-4/5"><strong>Résumé : </strong>{{ $show->description }}</p>

            <p class="mt-4">De
                @foreach ($show->auteurs as $auteur)
                {{ $auteur->firstname }} {{ $auteur->lastname }}
                @if ($loop->iteration == $loop->count - 1)
                et
                @elseif (!$loop->last)
                ,
                @endif
                @endforeach
            </p>

            @if (count($show->comediens) > 0)
            <p class="mt-4"> Avec :
                @foreach ($show->comediens as $comedien)
                {{ $comedien->firstname }} {{ $comedien->lastname }}
                @if ($loop->iteration == $loop->count - 1)
                et
                @elseif (!$loop->last)
                ,
                @endif
                @endforeach
            </p>
            @endif
        </div>

    </div>


    <!-- affichage des représentations -->

    <h2 class="text-2xl mt-12"><strong>Liste des représentations</strong></h2>
    @if ($show->representations->count() >= 1)

    <table class="mt-4 w-full table-fixed">
        <thead>
            <tr class="bg-gray-200">
                <th class="text-left">Date</th>
                <th class="text-left">Heure</th>
                <th class="text-left">Lieu</th>
                @auth
                <th class="text-right"></th>
                @endauth
            </tr>
        <tbody>
            @foreach ($show->representations as $representation)

            <tr class="even:bg-gray-200 text-md">
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
                @auth
                <td class="text-right">
                    <a href="{{ route('representation.book', $representation->id) }}" class="bg-pink-500 hover:bg-pink-700 text-white font-bold py-1 px-4 rounded">Réserver</a>
                </td>
                @endauth

            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="mt-4">Pas de représentation pour le moment</p>
    @endif

</article>

<div class="mt-4">
    <a href="{{ route('show.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline">Retour</a>
</div>

<!-- footer navigation contact -->

<!-- bandelette rose -->

<footer>
    <div class=" flex item-start bg-pink-500 mt-12">
        <div class="container mx-auto">
            <div class="flex justify-between items-center py-4">
                <!-- écrire texte en petit -->
                <div class="text-white text-sm ml-4">
                    <p><strong>Contact</strong></p>
                    @if ($show->location)
                    <p>{{ $show->location->designation }}</p>
                    <p>{{ $show->location->phone }}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- condition générales | protection de la vie privée  aligné à droite -->
        <div class="flex justify-between items-center py-4 w-1/2">
            <div class="text-white text-sm ml-4">
                <p><a href="">Conditions générales </a> | <a href=""> Protection de la vie privée </a></p>

            </div>
        </div>

</footer>



@endsection