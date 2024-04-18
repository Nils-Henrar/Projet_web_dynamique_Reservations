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
        Schema::create('shows', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 60)->unique();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->string('poster_url', 255)->nullable();
            $table->foreignId('location_id')->nullable();
            $table->boolean('bookable')->default(false);
            $table->decimal('price', 10, 2)->nullable();
            $table->timestamp('created_at')->useCurrent(); //useCurrent() est utilisé pour définir la valeur par défaut de la colonne à la date et l'heure actuelles
            $table->timestamp('updated_at')->nullable(); //nullable() est utilisé pour autoriser la valeur NULL dans la colonne

            $table->foreign('location_id')->references('id')->on('locations')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shows');
    }
};
