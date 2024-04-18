@extends ('layouts.main')

@section ('title', 'Roles')

@section ('content')

<h2 class="text-2xl mt-2">Roles</h2>

<div class="flex">
    <a href="{{ route('role.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded mt-4 mb-4">Ajouter un rôle</a>
</div>

<div class="mt-4">
    <ul class="mt-4">
        @foreach ($roles as $role)
        <li class="text-align: left mb-4">
            <!-- lien en tailwind -->
            <a href="{{ route('role.show', $role->id) }}" class="bg-white-500 hover:bg-gray-100 text-black font-bold py-1 px-3 rounded mt-4 mb-4 mr-2">{{ $role->role }}</a>
        </li>

        @endforeach
    </ul>
</div>

@endsection