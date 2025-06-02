<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Topic::factory()->count(10)->create()->each(function (Topic $topic) {
            $posts = \App\Models\Post::factory()->count(25)->make([
                // 'topic_id' tidak perlu diset di sini karena saveMany akan menanganinya
                // 'created_by' akan di-generate oleh PostFactory menggunakan User::factory()
            ]);
            $topic->posts()->saveMany($posts);

            // Untuk setiap post yang baru dibuat untuk topik ini, tambahkan komentar
            $posts->each(function (\App\Models\Post $post) {
                $comments = \App\Models\Comment::factory()->count(13)->make([
                    // 'post_id' tidak perlu diset di sini karena saveMany akan menanganinya
                    // 'created_by' atau 'user_id' akan di-generate oleh CommentFactory menggunakan User::factory()
                ]);
                $post->comments()->saveMany($comments);
            });
        });
    }
}
