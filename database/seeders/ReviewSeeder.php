<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Show;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        // Empty the table first

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('reviews')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Define data

        $reviews = [
            [
                'user_login' => 'bob',
                'show_slug' => 'cible-mouvante',
                'review' => 'Super spectacle !',
                'stars' => 4,
            ],

        ];

        // Prepare the data

        // Search the user for a given user's login

        foreach ($reviews as &$data) {
            $user = User::firstWhere('login', $data['user_login']);

            $show = Show::firstWhere('slug', $data['show_slug']);




            unset($data['user_login']);
            unset($data['show_slug']);

            $data['user_id'] = $user->id;
            $data['show_id'] = $show->id;
        }

        // Insert the data in the table

        DB::table('reviews')->insert($reviews);
    }
}
