<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Representation;
use App\Models\User;
use App\Models\Show;
use App\Models\Location;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // empty the table first

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('reservations')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Define data

        $reservations = [
            [
                'user_login' => 'bob',
                'booking_date' => '2012-10-10 10:00:00',
                'status' => null,
            ],

            [
                'user_login' => 'nils',
                'booking_date' => '2012-10-08 10:00:00',
                'status' => null,
            ],

            [
                'user_login' => 'john',
                'booking_date' => '2012-10-15 10:00:00',
                'status' => null,
            ],

        ];

        //Prepare the data

        //Search the user for a given user's login

        foreach ($reservations as &$data) {
            $user = User::firstWhere('login', $data['user_login']);
            unset($data['user_login']);

            $data['user_id'] = $user->id;
        }

        //Insert the data in the table

        DB::table('reservations')->insert($reservations);
    }
}
