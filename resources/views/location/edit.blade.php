@extends ('layouts.main')

@section ('title', 'Edit a location')

@section ('content')

<h1 class="text-2xl">Modifier lieu de spectacle</h1>

<form action="{{ route('location.update', $location->id) }}" method="POST" class="mt-4">

    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="designation" class="block text-gray-700 text-sm font-bold mb-2">Désignation</label>
        <input type="text" name="designation" id="designation" @if(old('designation')) value="{{ old('designation') }}" @else value="{{ $location->designation }}" @endif class="@error('designation') is-invalid @enderror shadow appearance-none border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        @error('designation')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Adresse</label>
        <input type="text" name="address" id="address" @if(old('adress')) value="{{ old('address') }}" @else value="{{ $location->address }}" @endif class="@error('address') is-invalid @enderror shadow appearance-none border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        @error('adress')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="locality_id" class="block text-gray-700 text-sm font-bold mb-2">Localité</label>
        <select name="locality_id" id="locality_id" class="@error('locality_id') is-invalid @enderror shadow appearance-none border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @foreach($localities as $locality)
            <option value="{{ $locality->id }}" @if($locality->id == $location->locality_id) selected @endif>{{ $locality->locality }} {{ $locality->postal_code }}</option>
            @endforeach
        </select>
        @error('locality_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="website" class="block text-gray-700 text-sm font-bold mb-2">Site web</label>
        <input type="text" name="website" id="website" @if(old('website')) value="{{ old('website') }}" @else value="{{ $location->website }}" @endif class="@error('website') is-invalid @enderror shadow appearance-none border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        @error('website')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Téléphone</label>
        <input type="text" name="phone" id="phone" @if(old('phone')) value="{{ old('phone') }}" @else value="{{ $location->phone }}" @endif class="@error('phone') is-invalid @enderror shadow appearance-none border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        @error('phone')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>


    <div class="flex items-center justify-between">
        <a href="{{ route('location.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline">Retour</a>
        <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline">Modifier</button>
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