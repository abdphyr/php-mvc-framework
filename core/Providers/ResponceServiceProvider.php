<?php

namespace Abd\Mvc\Providers;

use Abd\Mvc\Response\Response;

class ResponceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind("response", Response::class);
    }
}
