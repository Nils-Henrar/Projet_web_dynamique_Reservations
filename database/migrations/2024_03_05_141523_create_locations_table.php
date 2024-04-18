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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 60)->unique();
            $table->string('designation', 60);
            $table->string('address', 255);
            $table->foreignId('locality_id');
            $table->string('website', 255)->nullable();
            $table->string('phone', 30)->nullable();

            $table->foreign('locality_id')->references('id')->on('localities')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            /**
             * foreign() est utilisé pour définir une clé étrangère, 
             * references() pour définir la colonne de référence, 
             * on() pour définir la table de référence, 
             * onDelete() pour définir l'action à effectuer lors de la suppression de la ligne de référence, 
             * onUpdate() pour définir l'action à effectuer lors de la mise à jour de la ligne de référence
             */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
