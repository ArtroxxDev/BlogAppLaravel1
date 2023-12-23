<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->unique()->realText(55);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'image' => '/articles'.$this->faker->image('public/storage/articles', 640, 480, false)

            /**
             * Que pasa si en el ultimo argumento colocamos otra cosa?
             * al poner true indicamos que queremos fullpath, cuyo directorio es public/storage/articles
             * al poner false indicamos que solo queremos /imagen.png
             * Al colocar la concatenacion de '/articles' antes de la programacion que representa basicamente la imagen, indicamos que el directorio será '/articles/imagen.png'
             * las imagenes se almacenan por faker en /storage, pero desde el servidor no tenemos acceso a ese directorio, por lo que deberemos realizar un acceso directo desde public
             * para realizarlo, desde la terminal hacemos el comando php artisan storage:link
             */

        ];
    }
}
