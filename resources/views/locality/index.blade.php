@extends ('layouts.main')

@section ('title', 'Localities')

@section ('content')

<h2 class="text-2xl mt-2">{{__('locality.place')}}</h2>

<div class="flex">
    <a href="{{ route('locality.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded mt-4 mb-4">{{__('locality.locality_add')}}</a>
</div>

<div class="mt-4">
    <ul class="mt-4">
        @foreach ($localities as $locality)
        <li class="text-align: left mb-4">
            <!-- lien en tailwind -->
            <a href="{{ route('locality.show', $locality->id) }}" class="bg-white-500 hover:bg-gray-100 text-black font-bold py-1 px-3 rounded mt-4 mb-4 mr-2">{{ $locality->postal_code }} - {{ $locality->locality }}</a>
        </li>
        @endforeach
    </ul>
</div>

@endsection