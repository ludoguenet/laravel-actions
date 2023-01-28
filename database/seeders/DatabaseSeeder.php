<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Post::factory()
            ->times(50)
            ->create([
                'user_id' => User::factory(),
            ])
            ->each(static function ($post) {
                $post->comments()->saveMany(
                    Comment::factory()->times(random_int(2, 5))->make(),
                );

                $post->likes()->saveMany(
                    Like::factory()->times(random_int(2, 5))->make(),
                );
            });
    }
}
