<?php

namespace Abd\Mvc\Facades;


abstract class Facade
{
    protected static $app;
    public static $instance;
    abstract static function getAccessor(): string;
    public static function getInstance()
    {
        if(isset(static::$app[static::getAccessor()])) {
            return static::$app[static::getAccessor()];
        } else {
            return null;
        }
    }
}
