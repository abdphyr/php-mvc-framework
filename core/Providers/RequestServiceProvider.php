<?php

namespace Abd\Mvc\Providers;

use Abd\Mvc\Request\Request;

class RequestServiceProvider extends Provider
{
    public function register()
    {
        $this->app->bind("request", Request::class);
    }
}
