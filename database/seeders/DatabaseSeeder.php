<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        /**
         * 24/12/23
         * Creamos 2 funciones adicionales para elaborar seeders sin que estos se pisen
         * el primer grupo de funciones eliminara las carpetas de categories y articles
         * el segundo grupo de funciones creara nuevamente las mismas, asi al ejecutarse nos aseguramos de que no se acumulen los datos de prueba innecesariamente
         */

         //Eliminar los directorios
         Storage::deleteDirectory('articles');
         Storage::deleteDirectory('categories');

         //Crear nuevamente los directorios
         Storage::makeDirectory('articles');
         Storage::makeDirectory('categories');

        //php artisan migrate:fresh --seed
        $this->call(UserSeeder::class);

        //aqui llamamos a las factories para crear category, article y comment
        Category::factory(8)->create();
        Article::factory(20)->create();
        Comment::factory(20)->create();
    }
}
