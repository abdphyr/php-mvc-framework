<?php

namespace Abd\Mvc;

use Abd\Mvc\Kernel\Kernel;

class App
{
    public static Kernel $app;
    public function __construct($kernel)
    {
        self::$app = $kernel;
    }
    public function boot($kernel): Kernel
    {
        self::$app = $kernel;
        return self::$app;
    }

    public static function helper($accessor)
    {
        return self::$app->instance($accessor);
    }

    public function load()
    {
        self::$app->load();
    }

    public function run()
    {
        self::$app->run();
    }
    
    public function end()
    {
        self::$app->kill();
        // self::$app = null;
    }
}
