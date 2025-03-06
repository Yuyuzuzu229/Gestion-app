<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('name'); // Supprime la colonne 'name'
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('name'); // Si on annule la migration, on recrée la colonne 'name'
    });
}

};
