<?php

namespace App\Providers;

use Abd\Mvc\Providers\ServiceProvider;
use App\Middlewares\AuthMiddleware;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        middleware()->registerMiddleware("auth", AuthMiddleware::class);
    }
}
