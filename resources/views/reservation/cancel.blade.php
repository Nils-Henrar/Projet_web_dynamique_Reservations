@extends ('layouts.main')

@section('title', 'Annulation de la réservation')

@section('content')

<h2 class="text-3xl mt-2">Annulation de la réservation</h2>

<div class="mt-4">
    <p>Votre réservation a été annulée.</p>
</div>

<div class="mt-12">
    <a href="{{ route('show.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded mt-4 mb-4">Retour à la liste des spectacles</a>
</div>

@endsection