@extends ('layouts.main')

@section ('title', 'Fiche d\'un rôle')

@section ('content')

<h1 class="text-2xl mt-4">Role : {{ $role->role }}</h1>

<div class="mt-4">
    <a href="{{ route('role.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline">Back</a>
    <a href="{{ route('role.edit', $role->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline">Edit</a>
</div>

@endsection