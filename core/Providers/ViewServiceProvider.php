<?php

namespace Abd\Mvc\Providers;

use Abd\Mvc\View\View;

class ViewServiceProvider extends Provider
{
    public function register()
    {
        $this->app->bind("view", View::class);
    }
}
