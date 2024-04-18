<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Representation;
use App\Models\Show;
use App\Models\Location;
use App\Models\User;
use App\Models\Price;
use App\Models\Reservation;

class RepresentationReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Empty the table first

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('representation_reservation')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Define data

        $representationReservations = [
            [
                // Representation (show_slug, location_slug, representation_date)
                'show_slug' => 'ayiti',
                'location_slug' => 'dexia-art-center',
                'representation_date' => '2012-10-12 20:30:00',

                // Reservation (user_login, reservation_date, reservation_status)
                'user_login' => 'bob',
                'reservation_date' => '2012-10-10 10:00:00',
                'reservation_status' => null,

                // Price (price_type, price, price_start_date, price_end_date)
                'price_type' => 'Adulte',
                'price' => 24.00,
                'price_start_date' => '2012-10-01',
                'price_end_date' => '2012-12-31',

                // Quantity
                'quantity' => 2,
            ],

            [
                'show_slug' => 'ayiti',
                'location_slug' => 'espace-delvaux-la-venerie',
                'representation_date' => '2012-10-12 13:30:00',
                'user_login' => 'nils',
                'reservation_date' => '2012-10-08 10:00:00',
                'reservation_status' => null,
                'price_type' => 'Étudiant',
                'price' => 10.00,
                'price_start_date' => '2012-10-01',
                'price_end_date' => null,
                'quantity' => 1,
            ],

            [
                'show_slug' => 'cible-mouvante',
                'representation_date' => '2012-10-02 20:30:00',
                'user_login' => 'john',
                'reservation_date' => '2012-10-15 10:00:00',
                'reservation_status' => null,
                'price_type' => 'Senior',
                'price' => 18.00,
                'price_start_date' => '2012-10-01',
                'price_end_date' => null,
                'quantity' => 1,
            ],
        ];

        // Prepare the data

        // Search the representation for the given show, location and date

        foreach ($representationReservations as &$representationReservation) {

            // on cherche le slug du show dans la table show et on récupère la première ligne car slug est unique
            $show = Show::where('slug', $representationReservation['show_slug'])->first();

            // Si 'location_slug' est défini, essayez de trouver la 'location' correspondante
            $locationId = null; // Par défaut à null
            if (!empty($representationReservation['location_slug'])) {
                $location = Location::where('slug', $representationReservation['location_slug'])->first();
                $locationId = $location ? $location->id : null;
            }

            // maintenant que j'ai récupéré le show et la location, je peux chercher la représentation correspondante
            // Trouvez la 'representation' en utilisant 'show_id' et le 'schedule',
            // en prenant en compte que 'location_id' peut être null
            $representationQuery = Representation::where('show_id', $show->id)
                ->where('schedule', $representationReservation['representation_date']);
            if ($locationId !== null) {
                $representationQuery->where('location_id', $locationId);
            } else {
                $representationQuery->whereNull('location_id');
            }
            $representation = $representationQuery->first();
            // on cherche le login de l'utilisateur dans la table user et on récupère la première ligne car login est unique
            $user = User::where('login', $representationReservation['user_login'])->first();

            // maintenant que j'ai récupéré le user, je peux chercher la réservation correspondante
            $reservation = Reservation::where('user_id', $user->id)
                ->where('booking_date', $representationReservation['reservation_date'])
                ->where('status', $representationReservation['reservation_status'])
                ->first();

            // on cherche le type, le prix, la date de début et la date de fin du prix dans la table price et on récupère la première ligne car ces quatre champs représentent un seul prix
            $price = Price::where('type', $representationReservation['price_type'])
                ->where('price', $representationReservation['price'])
                ->where('start_date', $representationReservation['price_start_date'])
                ->where('end_date', $representationReservation['price_end_date'])
                ->first();

            unset($representationReservation['show_slug']);
            unset($representationReservation['location_slug']);
            unset($representationReservation['representation_date']);
            unset($representationReservation['user_login']);
            unset($representationReservation['price_type']);
            unset($representationReservation['price']);
            unset($representationReservation['price_start_date']);
            unset($representationReservation['price_end_date']);
            unset($representationReservation['reservation_date']);
            unset($representationReservation['reservation_status']);



            $representationReservation['representation_id'] = $representation->id;
            $representationReservation['price_id'] = $price->id;
            $representationReservation['reservation_id'] = $reservation->id;
        }

        unset($representationReservation);

        // Insert the data in the table

        DB::table('representation_reservation')->insert($representationReservations);
    }
}
