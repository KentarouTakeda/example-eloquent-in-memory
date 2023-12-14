<?php

namespace Tests\Feature\Models;

use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Tests\Feature\Models\Traits\InMemoryDatabaseForTesting;
use Tests\TestCase;

class PostTagTest extends TestCase
{
    use InMemoryDatabaseForTesting;

    public function testFactory(): void
    {
        $postTag = PostTag::factory()->create();
        $this->assertInstanceOf(PostTag::class, $postTag);
    }

    public function testBelongsToPost(): void
    {
        $postTag = PostTag::factory()->create();
        $this->assertInstanceOf(Post::class, $postTag->post);
    }

    public function testBelongsToTag(): void
    {
        $postTag = PostTag::factory()->create();
        $this->assertInstanceOf(Tag::class, $postTag->tag);
    }
}
