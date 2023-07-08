<?php

namespace Abd\Mvc\Providers;

use Abd\Mvc\Auth\Auth;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind("auth", Auth::class);
    }
}
