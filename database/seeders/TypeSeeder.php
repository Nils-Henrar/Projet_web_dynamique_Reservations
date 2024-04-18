<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //auteur, scnéographe, metteur en scène, comédien, chanteur, danseur, musicien, technicien, régisseur, costumier, maquilleur, accessoiriste
        //empty the table first
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('types')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        //Define the data

        $types = [
            ['type' => 'auteur'],
            ['type' => 'scénographe'],
            ['type' => 'metteur en scène'],
            ['type' => 'comédien'],
            ['type' => 'chanteur'],
            ['type' => 'danseur'],
            ['type' => 'musicien'],
            ['type' => 'technicien'],
            ['type' => 'régisseur'],
            ['type' => 'costumier'],
            ['type' => 'maquilleur'],
            ['type' => 'accessoiriste'],
        ];

        //Insert the data in the table

        DB::table('types')->insert($types);
    }
}
