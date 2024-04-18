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
        Schema::table('users', function (Blueprint $table) {

            // Ajouter les nouvelles colonnes avant de modifier les colonnes existantes
            $table->string('lastname', 60)->after('name');
            $table->string('login', 30)->after('id');
            $table->string('langue', 2)->after('email');

            // Renommer la colonne name en firstname
            $table->renameColumn('name', 'firstname');

            // Définir la contrainte d'unicité sur la colonne login
            $table->unique('login', 'users_login_unique');
        });

        Schema::table('users', function (Blueprint $table) {
            // changer la taille de la colonne firstname
            $table->string('firstname', 60)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_login_unique');
            $table->renameColumn('firstname', 'name');
            $table->dropColumn('langue');
            $table->dropColumn('login');
            $table->dropColumn('lastname');
        });
    }
};
