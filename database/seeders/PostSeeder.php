<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        $deletedAt = now()->subDays(45);

        for ($i = 1; $i <= 5; $i++) {
            Post::create([
                'user_id' => $user->id,
                'title' => "Old Post {$i}",
                'body' => 'This post was soft-deleted 45 days ago.',
            ]);
        }

        Post::query()->update(['deleted_at' => $deletedAt]);
    }
}
