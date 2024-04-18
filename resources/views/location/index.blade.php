@extends ('layouts.main')

@section ('title', 'Lieux')

@section ('content')

<h2 class="text-3xl mt-2">Lieux de représentation</h2>

<div class="flex">
    <a href="{{ route('location.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded mt-4 mb-4">Ajouter un lieu</a>
</div>

<div class="mt-4">
    <ul class="mt-4">
        @foreach ($locations as $location)
        <li class="text-align: left mb-4 mt-4">
            <!-- lien en tailwind -->
            <a href="{{ route('location.show', $location->id) }}" class="bg-pink-500 hover:bg-pink-700 text-white font-bold py-1 px-3 rounded mt-4 mb-4 mr-2">{{ $location->designation }}</a>
        </li>
        <!-- les différentes classes de liste en tailwind sont list-disc, list-decimal, list-inside, list-outside, list-none -->
        <li class="ml-3">
            {{ $location->address }}
        </li>
        <li class="ml-3">
            {{ $location->locality->postal_code }} {{ $location->locality->locality }}
        </li>
        @if ($location->website)
        <li class="ml-3">
            <!-- faire un lien cliquable pour le website -->
            <a href="{{ $location->website }}" class="text-blue-500 hover:text-blue-700 visited:text-purple-500">{{ $location->website }}</a>
        </li>
        @endif

        @if ($location->phone)
        <li class="ml-3">
            {{ $location->phone }}
        </li>
        @endif
        @endforeach
    </ul>
</div>

@endsection