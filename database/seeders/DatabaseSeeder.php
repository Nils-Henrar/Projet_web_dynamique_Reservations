<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Artist;
use App\Models\Representation;
use App\Models\Reservation;
use App\Models\Role;
use App\Models\Show;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //Artist::factory()->count(10)->create();

        $this->call([
            TypeSeeder::class,
            LocalitySeeder::class,
            LocationSeeder::class,
            ArtistSeeder::class,
            RoleSeeder::class,
            ShowSeeder::class,
            RepresentationSeeder::class,
            ArtistTypeSeeder::class,
            ArtistTypeShowSeeder::class,
            UserSeeder::class,
            UserRoleSeeder::class,
            PriceSeeder::class,
            ReservationSeeder::class,
            RepresentationReservationSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
