<?php

return [
    "providers" => [
        Abd\Mvc\Providers\RequestServiceProvider::class,
        Abd\Mvc\Providers\ResponceServiceProvider::class,
        Abd\Mvc\Providers\RouterServiceProvider::class,
        Abd\Mvc\Providers\AuthServiceProvider::class,
        Abd\Mvc\Providers\DatabaseServiceProvider::class,
        Abd\Mvc\Providers\MiddlewareServiceProvider::class,
        Abd\Mvc\Providers\SessionServiceProvider::class,
        Abd\Mvc\Providers\ViewServiceProvider::class,
        App\Providers\AppServiceProvider::class
    ],
    "middlewares" => [
        "auth" => App\Middlewares\AuthMiddleware::class
    ]
];
