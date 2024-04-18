<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */




    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $users = [
            [
                'login' => 'bob',
                'firstname' => 'Bob',
                'lastname' => 'Sull',
                'email' => 'bob@sull.com',
                'password' => 'epfc1234',
                'langue' => 'fr',
                'created_at' => '',

            ],

            [
                'login' => 'john',
                'firstname' => 'John',
                'lastname' => 'Doe',
                'email' => 'john@doe.com',
                'password' => 'epfc1234',
                'langue' => 'en',
                'created_at' => '',
            ],

            [
                'login' => 'jane',
                'firstname' => 'Jane',
                'lastname' => 'Doe',
                'email' => 'jane@doe.com',
                'password' => 'epfc1234',
                'langue' => 'en',
                'created_at' => '',
            ],

            [
                'login' => 'nils',
                'firstname' => 'Nils',
                'lastname' => 'Henrar',
                'email' => 'nils@henrar.com',
                'password' => 'epfc1234',
                'langue' => 'fr',
                'created_at' => '',
            ],
        ];

        foreach ($users as &$user) {


            $user['password'] = Hash::make($user['password']);
            $user['created_at'] = Carbon::now()->toDateTimeString();
        }

        DB::table('users')->insert($users); // ou User::insert($users);

    }
}
