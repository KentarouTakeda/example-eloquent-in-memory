<?php

namespace Tests\Feature\Models;

use App\Models\User;
use Illuminate\Support\Facades\ParallelTesting;
use Tests\TestCase;

class UserTest extends TestCase
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
        $user = User::factory()->create();
        $this->assertInstanceOf(User::class, $user);
    }
}
