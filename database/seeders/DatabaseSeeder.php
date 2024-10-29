<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'email' => 'admin@sanchez.fr',
            'password' => bcrypt('password1')
        ]);

        User::factory(10)->create();

        //Movie::factory(50)->create();
    }
}
