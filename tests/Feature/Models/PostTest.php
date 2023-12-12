<?php

namespace Tests\Feature\Models;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
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

    #[Test]
    public function 公開済の記事_公開日時が現時刻より後の場合は未公開()
    {
        $this->travelTo(now());

        Post::factory([
            'published_at' => now()->addMinutes(1),
        ])->create();

        $post = Post::query()->whereIsPublished()->first();

        $this->assertNull($post);
    }

    #[Test]
    public function 公開済の記事_公開日時が現時刻より前の場合は公開済()
    {
        $this->travelTo(now());

        Post::factory([
            'published_at' => now(),
        ])->create();

        $post = Post::query()->whereIsPublished()->first();

        $this->assertNotNull($post);
    }
}
