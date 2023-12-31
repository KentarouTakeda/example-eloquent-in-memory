<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'subject' => fake()->sentence(),
            'content' => fake()->paragraphs(3, true),
            'published_at' => fake()->boolean() ?
                fake()->dateTimeBetween('-1 year', '+1 year')
            : null,
        ];
    }

    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'published_at' => fake()
                ->dateTimeBetween(now()->subDays(7), now()),
        ]);
    }
}
