<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Supprimer la contrainte de clé étrangère avant de supprimer la colonne
            $table->dropForeign(['representation_id']);

            // Supprimer les colonnes qui ne sont plus nécessaires
            $table->dropColumn(['representation_id', 'places']);

            // Ajouter les nouvelles colonnes
            $table->timestamp('booking_date')->useCurrent()->after('user_id');
            $table->string('status')->nullable()->after('booking_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->integer('places');

            // Ajouter la contrainte de clé étrangère après avoir ajouté la colonne
            $table->foreignId('representation_id')->references('id')->on('representations')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            // Supprimer les colonnes ajoutées
            $table->dropColumn(['booking_date', 'status']);
        });
    }
};
