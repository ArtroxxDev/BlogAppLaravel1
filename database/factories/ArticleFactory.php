<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
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
            'introduction' => $this->faker->realText(255),
            'image' => '/articles'.$this->faker->image('public/storage/articles', 640, 480, null, false),

            /**
             * Que pasa si en el ultimo argumento colocamos otra cosa?
             * al poner true indicamos que queremos fullpath, cuyo directorio es public/storage/articles
             * al poner false indicamos que solo queremos /imagen.png
             * Al colocar la concatenacion de '/articles' antes de la programacion que representa basicamente la imagen, indicamos que el directorio será '/articles/imagen.png'
             * las imagenes se almacenan por faker en /storage, pero desde el servidor no tenemos acceso a ese directorio, por lo que deberemos realizar un acceso directo desde public
             * para realizarlo, desde la terminal hacemos el comando php artisan storage:link
             */
            'body' => $this->faker->text(2000),
            'status' => $this->faker->boolean(),
            'user_id' => User::all()->random()->id,
            'category_id' => Category::all()->random()->id,


        ];
    }
}
