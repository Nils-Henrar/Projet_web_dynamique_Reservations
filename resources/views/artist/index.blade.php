@extends ('layouts.main')

@section ('title', 'Liste des artistes')

@section ('content')

<div class="flex items-center justify-between mt-4">
    <h1 class="text-2xl text-pink-500">{{__('artists.title', ['total' => sizeof($artists)])}}</h1>
    
    <a href="{{ route('artist.create') }}" class="bg-pink-500 hover:bg-pink-700 text-white font-bold py-1 px-3 rounded">{{__('artists.add_artist')}}</a>
</div>
<ul class="flex flex-wrap mt-4">
    @foreach ($artists as $artist)
    <li class="w-1/3 p-2 text-gray-700"><a href="{{ route('artist.show', $artist->id) }}" class="hover:text-pink-500"> {{ $artist->firstname }} {{ $artist->lastname }}
            <!-- les types de l'artiste -->
            (
            @foreach ($artist->types as $type)
            <span class="text-xs bg">{{ __('artists.types.' . $type->type) }}</span>
            @if (!$loop->last)
            /
            @else
            )
            @endif
            @endforeach
        </a>
    </li>

    @endforeach
</ul>




@endsection