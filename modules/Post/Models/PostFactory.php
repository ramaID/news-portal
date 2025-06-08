<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'topic_id' => $this->faker->words(3, true),
            'created_by' => $this->faker->word(),
            'title' => $this->faker->sentence(3),
            'slug' => $this->faker->slug(),
            'summary' => $this->faker->text(),
            'body' => $this->faker->text(),
            'featured_image' => $this->faker->words(3, true),
            'status' => $this->faker->words(3, true),
            'published_at' => $this->faker->dateTime(),
        ];
    }
}
