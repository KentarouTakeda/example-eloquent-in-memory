<?php

namespace Tests\Feature\Models;

use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Support\Facades\ParallelTesting;
use Tests\TestCase;

class PostTagTest extends TestCase
{
    public function setUp(): void
    {
        $this->refreshApplication();
        ParallelTesting::callSetUpTestCaseCallbacks($this);
        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite.database', ':memory:');

        parent::setUp();
        $this->artisan('migrate');
    }

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
