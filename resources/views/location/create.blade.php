@extends ('layouts.main')

@section ('title', 'Ajouter un lieu')

@section ('content')

<h1 class="text-3xl mt-4">{{__('location.add')}}</</h1>

<form action="{{ route('location.store') }}" method="POST" class="mt-4">
    @csrf
    <div class="flex flex-col">
        <label for="designation">{{__('location.designation')}}</label>
        <input type="text" name="designation" id="designation" class="border border-gray-400 p-2 mt-2">
        @error('designation')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>
    <div class="flex flex-col mt-4">
        <label for="address">{{__('location.adress')}}</label>
        <input type="text" name="address" id="address" class="border border-gray-400 p-2 mt-2">
        @error('address')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>
    <div class="flex flex-col mt-4">
        <label for="locality_id">{{__('location.locality')}}</label>
        <select name="locality_id" id="locality_id" class="border border-gray-400 p-2 mt-2">
            <option value="">-- {{__('location.choose')}} --</option>
            @foreach($localities as $locality)
            <option value="{{ $locality->id }}">{{ $locality->locality }} {{ $locality->postal_code }}</option>
            @endforeach
        </select>
        @error('locality_id')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-col mt-4">
        <label for="website">{{__('location.website')}}</label>
        <input type="text" name="website" id="website" class="border border-gray-400 p-2 mt-2">
        @error('website')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-col mt-4 mb-4">
        <label for="phone">{{__('location.phone')}}</label>
        <input type="text" name="phone" id="phone" class="border border-gray-400 p-2 mt-2">
        @error('phone')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center justify-between">
        <a href="{{ route('artist.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline">{{__('shows.bt_return')}}</a>
        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline">{{__('artists.modify')}}</button>
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