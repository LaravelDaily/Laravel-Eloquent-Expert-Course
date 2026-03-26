<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PasswordResetTokenSeeder extends Seeder
{
    public function run(): void
    {
        $createdAt = now()->subDays(30);

        for ($i = 1; $i <= 5; $i++) {
            DB::table('password_reset_tokens')->insert([
                'email' => "prunable-user-{$i}@example.com",
                'token' => Str::random(60),
                'created_at' => $createdAt,
            ]);
        }
    }
}
