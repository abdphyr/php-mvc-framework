<?php

namespace Abd\Mvc\Providers;

use Abd\Mvc\Router\Router;

class RouterServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind("router", Router::class);
    }
}
