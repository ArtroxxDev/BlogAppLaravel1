<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * añadimos nuevas columnas a la tabla de profiles por medio de una nueva migracion.
     */
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
             $table->string('profession', 60)->nullable();
             $table->string('about', 255)->nullable();
             $table->string('twitter', 100)->nullable();
             $table->string('linkedin', 100)->nullable();
             $table->string('facebook', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            //
        });
    }
};
