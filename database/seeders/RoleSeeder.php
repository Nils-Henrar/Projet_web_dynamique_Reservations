<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        //

        //empty the table first
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        //Define the data

        $roles = [
            ['role' => 'admin'],
            ['role' => 'member'],
            ['role' => 'affiliate'],
        ];

        //Insert the data in the table

        DB::table('roles')->insert($roles);
    }
}
