@extends ('layouts.main')

@section ('title', 'Ajouter un artiste')

@section ('content')

<h1 class="text-3xl">{{__('artists.add_artist')}}</h1>

<form action="{{ route('artist.store') }}" method="POST" class="mt-4">

    @csrf

    <div class="mb-4">
        <label for="firstname" class="block text-gray-700 text-lg font-bold mb-2">{{__('artists.firstname')}}</label>
        <input type="text" name="firstname" id="firstname" @if(old('firstname')) value="{{ old('firstname') }}" @endif class="@error('firstname') is-invalid @enderror shadow appearance-none border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

        @error('firstname')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="lastname" class="block text-gray-700 text-lg font-bold mb-2">{{__('artists.lastname')}}</label>
        <input type="text" name="lastname" id="lastname" @if(old('lastname')) value="{{ old('lastname') }}" @endif class="@error('lastname') is-invalid @enderror shadow appearance-none border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

        @error('lastname')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">{{__('artists.skills')}}</label>
        @foreach($types as $type)
        <div>
            <input type="checkbox" name="types[]" value="{{ $type->id }}" id="type{{ $type->id }}">
            <label for="type{{ $type->id }}">{{ __('artists.types.' . $type->type) }}</label>
        </div>
        @endforeach
        @error('types')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="flex items-center justify-between">
        <a href="{{ route('artist.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline">{{__('artists.return')}}</a>
        <button type="submit" class="bg-pink-500 hover:bg-green-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline">{{__('artists.add')}}</button>
    </div>



    @if ($errors->any())
    <div class="alert alert-danger mt-4">
        <h2>Listes des erreurs de validation</h2>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>

    @endif

</form>

@endsection