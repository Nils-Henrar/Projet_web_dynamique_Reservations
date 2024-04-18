@extends ('layouts.main')

@section ('title', 'Types')

@section ('content')

<h2 class="text-2xl mt-2">Types</h2>

<div class="flex">
    <a href="{{ route('type.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded mt-4 mb-4">Add a type</a>

</div>
<div class="mt-4">
    <ul class="mt-4">
        @foreach ($types as $type)
        <li class="text-align: left mb-4">
            <!-- lien en tailwind -->
            <a href="{{ route('type.show', $type->id) }}" class="bg-white-500 hover:bg-gray-300 text-black font-bold py-1 px-3 rounded mt-4 mb-4 mr-2">{{ $type->type }}</a>
        </li>

        @endforeach
    </ul>
</div>

@endsection