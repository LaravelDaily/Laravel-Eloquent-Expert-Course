<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Ghost;
use App\Models\Network;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'birth_date' => '01/25/1990',
        ]);

        User::factory(3000)->create();
        Network::factory(1000)->create();
        Ghost::factory(1000)->create();
    }
}
