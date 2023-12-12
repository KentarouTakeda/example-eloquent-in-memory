<?php

namespace Tests\Feature\Models\Traits;

trait InMemoryDatabaseForTesting
{
    public function setUpInMemoryDatabaseForTesting()
    {
        $this->app['config']->set('database.default', 'sqlite');
        $this->app['config']->set('database.connections.sqlite.database', ':memory:');
        $this->artisan('migrate');
    }
}
