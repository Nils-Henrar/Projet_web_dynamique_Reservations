@extends ('layouts.main')

@section ('title', 'Mes réservations')

@section ('content')

<h1 class="text-3xl">Mes réservations</h1>
<table class="table-auto mt-4">
    <thead>
        <tr>
            <th class="px-4 py-2">Spectacle</th>
            <th class="px-4 py-2">Lieu</th>
            <th class="px-4 py-2">Date</th>
            <th class="px-4 py-2">Nom</th>
            <th class="px-4 py-2">Prénom</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Nombre de places</th>
            <th class="px-4 py-2">Prix total</th>
            <th class="px-4 py-2">Date de réservation</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reservations as $reservation)
        <tr>
            <td class="border px-4 py-2">{{ $reservation->details['show']->title }}</td>
            <td class="border px-4 py-2">{{ $reservation->details['representation']->location ? $reservation->details['representation']->location->designation : $reservation->details['show']->location->designation }}</td>
            <td class="border px-4 py-2">{{ $reservation->details['representation']->schedule }}</td>
            <td class="border px-4 py-2">{{ $reservation->user->lastname }}</td>
            <td class="border px-4 py-2">{{ $reservation->user->firstname }}</td>
            <td class="border px-4 py-2">{{ $reservation->user->email }}</td>
            <td class="border px-4 py-2">{{ $reservation->details['total_places'] }}</td>
            <td class="border px-4 py-2">{{ $reservation->details['total_price'] }} €</td>
            <td class="border px-4 py-2">{{ $reservation->booking_date }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection