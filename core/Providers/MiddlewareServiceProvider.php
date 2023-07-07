<?php

namespace Abd\Mvc\Providers;

use Abd\Mvc\Middleware\MiddlewareServie;

class MiddlewareServiceProvider extends Provider
{
    public function register()
    {
        $this->app->bind("middleware", MiddlewareServie::class);
    }
}
