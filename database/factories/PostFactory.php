<?php

namespace Database\Factories;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->unique()->sentence(nbWords: 6, variableNbWords: true); // Judul unik
        $isPublished = $this->faker->boolean(75); // 75% kemungkinan published

        return [
            'topic_id' => Topic::factory(), // Membuat atau mengambil Topic yang ada
            'created_by' => User::factory(),   // Membuat atau mengambil User yang ada (Writer)
            'title' => Str::title($title),
            'slug' => Str::slug($title),
            'body' => $this->faker->paragraphs(asText: true, nb: $this->faker->numberBetween(5, 15)), // 5-15 paragraf
            'featured_image' => $this->faker->imageUrl(1200, 800, 'news', true, 'cats'), // Contoh gambar berita
            'status' => $isPublished ? 'published' : 'draft',
            'published_at' => $isPublished ? $this->faker->dateTimeThisMonth() : null,
        ];
    }

    /**
     * Indicate that the post is in draft status.
     */
    public function draft(): Factory
    {
        return $this->state(
            fn () => ['status' => 'draft', 'published_at' => null]
        );
    }

    /**
     * Indicate that the post is published.
     */
    public function published(): Factory
    {
        return $this->state(
            fn () => ['status' => 'published', 'published_at' => $this->faker->dateTimeThisMonth()]
        );
    }
}
