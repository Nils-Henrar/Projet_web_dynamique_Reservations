<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::table('shows', function (Blueprint $table) {
            // Supprimer lechamps price
            $table->dropColumn('price');

            // Ajouter le champ duration
            $table->smallInteger('duration')->unsigned()->after('poster_url');

            // Ajouter la nouvelle colonne created_in de type year
            $table->year('created_in')->after('duration');
        });

        // Si nécessaire, copier les données de created_at à created_in ici avec une requête SQL brute
        // DB::statement("UPDATE shows SET created_in = YEAR(created_at)");

        Schema::table('shows', function (Blueprint $table) {
            // Supprimer l'ancienne colonne created_at après avoir copié les données
            $table->dropColumn('created_at');
            // SUpprimer l'ancienne colonne updated_at
            $table->dropColumn('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shows', function (Blueprint $table) {
            // Ajouter de nouveau le champs et price
            $table->decimal('price', 10, 2)->nullable();

            // Supprimer les champs duration et created_in
            $table->datetime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            // Supprimer le champ duration
            $table->dropColumn('duration');

            // Supprimer la nouvelle colonne created_in
            $table->dropColumn('created_in');
        });
    }
};
