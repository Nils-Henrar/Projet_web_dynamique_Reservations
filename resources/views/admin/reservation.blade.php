@extends('adminlte::page')

@section('title', 'Nouvelle Localité')

@section('content_header')
@stop

@section ('content')

<h1 class="text-3xl">Liste des réservations</h1>
<table class="table table-striped border">
    <thead>
        <tr>
            <th>Spectacle</th>
            <th>Lieu</th>
            <th>Date</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Nombre de places</th>
            <th>Prix total</th>
            <th>Date de réservation</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reservations as $reservation)
        <tr>
            <td>{{ $reservation->details['show']->title }}</td>
            <td>{{ $reservation->details['representation']->location ? $reservation->details['representation']->location->designation : $reservation->details['show']->location->designation }}</td>
            <td>{{ $reservation->details['representation']->schedule }}</td>
            <td>{{ $reservation->user->lastname }}</td>
            <td>{{ $reservation->user->firstname }}</td>
            <td>{{ $reservation->user->email }}</td>
            <td>{{ $reservation->details['total_places'] }}</td>
            <td>{{ $reservation->details['total_price'] }} €</td>
            <td>{{ $reservation->booking_date }}</td>
            <td>
            <form action="{{ route('admin.deletereservation',  $reservation->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette réservation ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">delete</button>
            </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop