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
        Schema::create('artist_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artist_id');
            $table->foreignId('type_id');

            $table->foreign('artist_id')->references('id')->on('artists')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('type_id')->references('id')->on('types')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_type');
    }
};
