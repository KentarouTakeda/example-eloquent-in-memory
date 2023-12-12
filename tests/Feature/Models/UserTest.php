<?php

namespace Tests\Feature\Models;

use App\Models\Post;
use App\Models\User;
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
}
