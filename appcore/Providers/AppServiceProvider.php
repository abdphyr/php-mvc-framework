<?php

namespace App\Providers;

use Abd\Mvc\Providers\Provider;
use App\Middlewares\AuthMiddleware;

class AppServiceProvider extends Provider
{
    public function register()
    {
        middleware()->registerMiddleware("auth", AuthMiddleware::class);
    }
}
