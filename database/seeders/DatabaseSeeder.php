<?php

namespace Database\Seeders;

use App\Models\Movie\Entity\Movie;
use App\Models\User\Entity\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        User::factory()->create([
//            'email' => 'admin@sanchez.fr',
//            'password' => bcrypt('password')
//        ]);

//        User::factory(10)->create();
//
//        Movie::factory(50)->create();
//
        $users = User::all();
        $movies = Movie::all();

        foreach ($users as $user) {
            $viewCount = rand(5, 15);

            for ($i = 0; $i < $viewCount; $i++) {
                $movie = $movies->random();

                $viewedAt = Carbon::now()->subDays(rand(0, 30))->setTime(rand(0, 23), rand(0, 59));

                $user->movies()->attach($movie->id, ['seen_at' => $viewedAt]);
            }
        }
    }
}
