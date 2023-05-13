<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // // \App\Models\User::factory()->create([
        // //     'name' => 'Test User',
        // //     'email' => 'test@example.com',
        // // ]);

        // Listing::factory(1000)->create();

        $user = User::factory()->create([
            'name' => 'papi Jake',
            'email' => 'papijake@gmail.com',
            'password' => 'hehehe'
        ]);

        Listing::factory(1000)->create([
            'user_id' => $user->id
        ]);
    }
}
