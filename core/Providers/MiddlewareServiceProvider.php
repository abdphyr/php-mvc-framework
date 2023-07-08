<?php

namespace Abd\Mvc\Providers;

use Abd\Mvc\Middleware\MiddlewareServie;

class MiddlewareServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind("middleware", MiddlewareServie::class);
    }
}
