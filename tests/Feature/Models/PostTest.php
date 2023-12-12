<?php

namespace Tests\Feature\Models;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Tests\Feature\Models\Traits\InMemoryDatabaseForTesting;
use Tests\TestCase;

class PostTest extends TestCase
{
    use InMemoryDatabaseForTesting;

    public function testFactory(): void
    {
        $post = Post::factory()->create();
        $this->assertInstanceOf(Post::class, $post);
    }

    public function testBelongsToUser(): void
    {
        $post = Post::factory()->create();
        $this->assertInstanceOf(User::class, $post->user);
    }

    public function testBelongsToManyTags(): void
    {
        $post = Post::factory()->has(Tag::factory())->create();
        $this->assertInstanceOf(Tag::class, $post->tags->first());
    }
}
