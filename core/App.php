<?php

namespace Abd\Mvc;

use Abd\Mvc\Kernel\Kernel;

class App
{
    public static Kernel $app;
    public static function boot($kernel): Kernel
    {
        self::$app = $kernel;
        return self::$app;
    }

    public static function helper($accessor)
    {
        return self::$app->instance($accessor);
    }
}
