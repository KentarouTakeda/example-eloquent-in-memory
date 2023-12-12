<?php

namespace Tests\Feature\Models;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\ParallelTesting;
use Tests\TestCase;

class TagTest extends TestCase
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
        $tag = Tag::factory()->create();
        $this->assertInstanceOf(Tag::class, $tag);
    }

    public function testBelongsToManyPosts(): void
    {
        $tag = Tag::factory()->hasPosts(Post::class)->create();
        $this->assertInstanceOf(Post::class, $tag->posts->first());
    }
}
