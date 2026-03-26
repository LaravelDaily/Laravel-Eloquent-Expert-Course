<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class PrunableUserSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            User::factory()->create([
                'last_login_at' => now()->subYears(2),
                'email_verified_at' => null,
            ]);
        }
    }
}
