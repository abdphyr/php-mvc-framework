<?php

namespace Abd\Mvc\Providers;

use Abd\Mvc\Session\Session;

class SessionServiceProvider extends Provider
{
    public function register()
    {
        $this->app->bind("session", Session::class);
    }
}
