<?php

namespace Abd\Mvc\Providers;

use Abd\Mvc\Request\Request;

class RequestServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind("request", Request::class);
    }
}
