<?php

namespace Tests\Feature\Models;

use App\Models\Post;
use App\Models\Tag;
use Tests\Feature\Models\Traits\InMemoryDatabaseForTesting;
use Tests\TestCase;

class TagTest extends TestCase
{
    use InMemoryDatabaseForTesting;

    public function testFactory(): void
    {
        $tag = Tag::factory()->create();
        $this->assertInstanceOf(Tag::class, $tag);
    }

    public function testBelongsToManyPosts(): void
    {
        $tag = Tag::factory()->hasPosts(Post::class)->create();
        $this->assertInstanceOf(Post::class, $tag->posts->first());
    }
}
