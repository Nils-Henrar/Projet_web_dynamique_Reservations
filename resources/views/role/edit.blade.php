@extends ('layouts.main')

@section ('title', 'Edit a role')

@section ('content')

<h1 class="text-2xl">Modifier un rôle</h1>

<form action="{{ route('role.update', $role->id) }}" method="POST" class="mt-4">

    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Rôle</label>
        <input type="text" name="role" id="role" @if(old('role')) value="{{ old('role') }}" @else value="{{ $role->role }}" @endif class="@error('role') is-invalid @enderror shadow appearance-none border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

        @error('role')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

    </div>

    <div class="flex items-center justify-between">
        <a href="{{ route('role.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline">Back</a>
        <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
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