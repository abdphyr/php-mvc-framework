<?php 
namespace Abd\Mvc\Facades;

use Abd\Mvc\Contracts\Auth as ContractsAuth;

class Auth extends Facade implements ContractsAuth
{
    public static function getAccessor(): string
    {
        return "auth";
    }

    public static function user()
    {
        self::getInstance()->user();
    }
}