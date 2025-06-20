<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->medium();
    }

    protected function ease(): void
    {
        Topic::factory()->count(20)->create()->each(function (Topic $topic) {
            $posts = Post::factory()->count(1_000)->make([
                // 'topic_id' tidak perlu diset di sini karena saveMany akan menanganinya
                // 'created_by' akan di-generate oleh PostFactory menggunakan User::factory()
            ]);
            $topic->posts()->saveMany($posts);

            // Untuk setiap post yang baru dibuat untuk topik ini, tambahkan komentar
            $posts->each(function (Post $post) {
                $comments = Comment::factory()->count(13)->make([
                    // 'post_id' tidak perlu diset di sini karena saveMany akan menanganinya
                    // 'created_by' atau 'user_id' akan di-generate oleh CommentFactory menggunakan User::factory()
                ]);
                $post->comments()->saveMany($comments);
            });
        });
    }

    protected function medium(): void
    {
        $topics = Topic::factory()->count(10)->create();

        foreach ($topics as $topic) {
            // Generate posts without creating them in the DB yet
            $posts = Post::factory()->count(1_000)->make([
                'topic_id' => $topic->id, // Manually set the foreign key
            ]);

            foreach (array_chunk($posts->toArray(), 100) as $chunks) { // Chunk posts to avoid memory issues
                $postIDs = [];
                $batchPosts = [];
                foreach ($chunks as $post) {
                    $postIDs[] = $post['id'] = Str::uuid()->toString(); // Generate a UUID for each post
                    $batchPosts[] = $post; // Collect post data to insert later
                }

                // Insert posts in chunks to avoid memory issues
                Post::insert($batchPosts); // Batch insert posts

                $comments = Comment::factory()->count(13)->make(['post_id' => Arr::random($postIDs)]);

                $batchComments = [];
                foreach ($comments->toArray() as $comment) {
                    $comment['id'] = Str::ulid()->toString(); // Generate a UUID for each comment
                    $batchComments[] = $comment; // Collect comment data to insert later
                }

                Comment::insert($batchComments);
            }
        }
    }

    protected function fast(): void
    {
        $topics = Topic::factory()->count(50)->create();

        foreach ($topics as $topic) {
            // Generate posts without creating them in the DB yet
            $posts = Post::factory()->count(3_200)->make([
                'topic_id' => $topic->id, // Manually set the foreign key
            ]);

            foreach (array_chunk($posts->toArray(), 200) as $chunks) { // Chunk posts to avoid memory issues
                $postIDs = [];
                $batchPosts = [];
                foreach ($chunks as $post) {
                    $postIDs[] = $post['id'] = Str::uuid()->toString(); // Generate a UUID for each post
                    $batchPosts[] = $post; // Collect post data to insert later
                }

                // Insert posts in chunks to avoid memory issues
                Post::insert($batchPosts); // Batch insert posts

                $comments = Comment::factory()->count(13)->make(['post_id' => Arr::random($postIDs)]);

                $batchComments = [];
                foreach ($comments->toArray() as $comment) {
                    $comment['id'] = Str::ulid()->toString(); // Generate a UUID for each comment
                    $batchComments[] = $comment; // Collect comment data to insert later
                }

                Comment::insert($batchComments);
            }
        }
    }
}
