<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostTag>
 */
class PostTagFactory extends Factory
{
    public function definition(): array
    {
        return [
            'post_id' => Post::factory(),
            'tag_id' => Tag::factory(),
        ];
    }
}
