<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'full_name' => 'Arturo Lopez',
            'email' => 'alsalinas12@gmail.com',
            'password' => Hash::make('789456')
        ]);

        User::create([
            'full_name' => 'Matias Salinas',
            'email' => 'alsalinas19@gmail.com',
            'password' => Hash::make('456123')
        ]);

        //llamamos al creador de clases 10 veces
        User::factory(10)->create();
    }
}
