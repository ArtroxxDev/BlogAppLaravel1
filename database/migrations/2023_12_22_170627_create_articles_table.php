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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            /**
             * 24/12/2023
             * Se hace un rollback para corregir las columnas de la tabla ya que se habia hecho una migracion sin
             * haber agregado las columnas de title y slug, se implementan en esta nueva migracion
             */
            $table->string('introduction', 255);
            $table->string('image', 255);
            $table->text('body');
            $table->boolean('status')->default(0);

            //Relacion con usuario
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            //Relacion con categorias
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
