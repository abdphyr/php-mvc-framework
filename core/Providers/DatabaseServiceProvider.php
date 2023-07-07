<?php

namespace Abd\Mvc\Providers;

use Abd\Mvc\Database\Database;

class DatabaseServiceProvider extends Provider
{
    public function register()
    {
        $this->app->bind("database", Database::class);
    }
}
