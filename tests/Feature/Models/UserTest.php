<?php

namespace Tests\Feature\Models;

use App\Models\Post;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Models\Traits\InMemoryDatabaseForTesting;
use Tests\TestCase;

class UserTest extends TestCase
{
    use InMemoryDatabaseForTesting;

    public function testFactory(): void
    {
        $user = User::factory()->create();
        $this->assertInstanceOf(User::class, $user);
    }

    public function testHasManyPosts(): void
    {
        $user = User::factory()->has(Post::factory())->create();
        $this->assertInstanceOf(Post::class, $user->posts->first());
    }

    #[Test]
    public function アクティブユーザの取得_7日以内に投稿したユーザーはアクティブ()
    {
        $this->travelTo(now());

        User::factory()->has(Post::factory([
            'updated_at' => now()->subDays(7),
        ])->published())->create();

        $user = User::query()->whereIsActive()->first();

        $this->assertNotNull($user);
    }

    #[Test]
    public function アクティブユーザの取得_投稿から7日以上経過している場合アクティブではない()
    {
        $this->travelTo(now());

        User::factory()->has(Post::factory([
            'updated_at' => now()->subDays(8),
        ])->published())->create();

        $user = User::query()->whereIsActive()->first();

        $this->assertNull($user);
    }
}
