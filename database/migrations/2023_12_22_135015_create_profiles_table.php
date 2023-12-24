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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('photo', 255)->nullable();
            /**
             * Las siguientes columnas seran añadidas por make:migration add_columns_to_table
             */
            // $table->string('profession', 60)->nullable();
            // $table->string('about', 255)->nullable();
            // $table->string('twitter', 100)->nullable();
            // $table->string('linkedin', 100)->nullable();
            // $table->string('facebook', 100)->nullable();
            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                //similar a $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
