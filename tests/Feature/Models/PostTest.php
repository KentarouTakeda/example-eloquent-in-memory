<?php

namespace Tests\Feature\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\ParallelTesting;
use Tests\TestCase;

class PostTest extends TestCase
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
        $post = Post::factory()->create();
        $this->assertInstanceOf(Post::class, $post);
    }

    public function testBelongsToUser(): void
    {
        $post = Post::factory()->create();
        $this->assertInstanceOf(User::class, $post->user);
    }
}
