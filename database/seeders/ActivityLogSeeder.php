<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivityLogSeeder extends Seeder
{
    public function run(): void
    {
        $createdAt = now()->subMonths(4);

        $records = [];
        for ($i = 1; $i <= 50; $i++) {
            $records[] = [
                'user_id' => null,
                'action' => "action_{$i}",
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        }

        DB::table('activity_logs')->insert($records);
    }
}
