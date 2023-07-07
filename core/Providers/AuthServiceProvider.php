<?php

namespace Abd\Mvc\Providers;

use Abd\Mvc\Auth\Auth;

class AuthServiceProvider extends Provider
{
    public function register()
    {
        $this->app->bind("auth", Auth::class);
    }
}
