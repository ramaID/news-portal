<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topic>
 */
class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(asText: true); // Menghasilkan 1-3 kata unik

        return [
            'name' => Str::title($name), // Mengkapitalkan setiap kata
            'slug' => Str::slug($name),
        ];
    }
}
