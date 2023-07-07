<?php

namespace Abd\Mvc\Providers;

use Abd\Mvc\Kernel\Kernel;

abstract class Provider
{
    protected Kernel $app;
    abstract function register();
    public function boot()
    {
    }
    public function __construct($app)
    {
        $this->app = $app;
    }
}
