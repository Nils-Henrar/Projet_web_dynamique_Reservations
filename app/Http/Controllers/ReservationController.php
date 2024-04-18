<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Representation;
use App\Models\Price;
use App\Models\RepresentationReservation;

class ReservationController extends Controller
{
    //

    public function index()
    {
        //
        $reservations = Reservation::all(); // ou Db::select('select * from reservations'); Db::table('reservations')->get();
        return view('reservation.index', [
            'reservations' => $reservations,
            'resource' => 'reservations'
        ]);
    }

    public function create()
    {
        //

        return view('reservation.create');
    }

    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'representation_id' => 'required|exists:representations,id',
            'places.adulte' => 'nullable|integer|min:0',
            'places.enfant' => 'nullable|integer|min:0',
            'places.senior' => 'nullable|integer|min:0',
        ]);

        // set strip api key
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $reservation = new Reservation([
            'user_id' => auth()->id(),
            'booking_date' => now(),
        ]);

        $reservation->save();


        // Récupérer l'identifiant de la représentation
        $representationId = $request->representation_id;
        $representation = Representation::findOrFail($representationId);

        $title = $representation->show->title;
        $location = $representation->location == null ? $representation->show->location->designation : $representation->location->designation;
        $schedule = $representation->schedule->format('d/m/Y H:i');


        // Récupérer les prix actuels de la base de données
        $currentPrices = Price::where('end_date', '=', null)->get();

        // Préparation des line_items pour Stripe
        $line_items = [];
        foreach ($request->get('places') as $type => $quantity) {
            if ($quantity > 0) {
                $price = $currentPrices->firstWhere('type', $type);
                if ($price) {
                    RepresentationReservation::create([
                        'representation_id' => $representationId,
                        'reservation_id' => $reservation->id,
                        'price_id' => $price->id,
                        'quantity' => $quantity,
                    ]);
                    // var_dump($representation->show->location->designation);
                    // var_dump($representation->location);
                    // die();

                    $line_items[] = [
                        'price_data' => [
                            'currency' => 'eur',
                            'unit_amount' => $price->price * 100, // Conversion en centimes
                            'product_data' => [
                                'name' => "{$quantity}x {$type} - {$representation->show->title}",
                                'description' => 'Réservation pour ' . $title . ' le ' . $schedule . ' à ' . $location,
                            ],
                        ],
                        'quantity' => $quantity,
                    ];
                }
            }
        }


        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => route('reservation.confirmation', ['id' => $reservation->id]),
            'cancel_url' => route('reservation.cancel', ['id' => $reservation->id]),
        ]);

        return redirect($checkout_session->url);
    }

    public function show(string $id)
    {
        //

        $reservation = Reservation::find($id);

        return view('reservation.show', [
            'reservation' => $reservation,
        ]);
    }

    public function edit(string $id)
    {
        //

    }

    public function update(Request $request, string $id)
    {
        // Validation des données du formulaire


    }

    public function destroy(string $id)
    {
        //
        $reservation = Reservation::find($id);
        $reservation->delete();
    }

    public function confirmation(string $id)
    {
        $reservation = Reservation::find($id);
        $reservation->status = 'success';
        $reservation->save();



        // il faut ajouter un enregistrement dans la table representation_reservation

        return view('reservation.confirmation');
    }

    public function cancel(string $id)
    {
        $reservation = Reservation::find($id);
        $reservation->status = 'canceled';
        $reservation->save();

        return view('reservation.cancel');
    }


    public function myReservations()
    {
        $reservations = Reservation::where('user_id', auth()->id())->get();

        return view('reservation.my-reservations', [
            'reservations' => $reservations,
        ]);
    }
}
