@extends ('layouts.main')

@section ('title', 'Fiche d\'un type')

@section ('content')

<h1 class="text-2xl mt-4">Type : {{ $type->type }}</h1>


<h2 class="text-2xl mt-4">Liste des artistes</h2>

<ul class="mt-4">
    @foreach ($type->artists as $artist)
    <li class="list-disc ml-8">
        {{$artist->firstname}} {{$artist->lastname}}
    </li>
    @endforeach
</ul>

<div class="mt-4">
    <a href="{{ route('type.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline">Back</a>
</div>

@endsection