<?php

use Abd\Mvc\App;
use Abd\Mvc\Auth\Auth;
use Abd\Mvc\Database\Database;
use Abd\Mvc\Middleware\MiddlewareServie;
use Abd\Mvc\Request\Request;
use Abd\Mvc\Response\Response;
use Abd\Mvc\Router\Router;
use Abd\Mvc\Session\Session;

if (!function_exists('request')) {
  function request(): Request
  {
    return App::helper('request');
  }
}

if (!function_exists("response")) {
  function response(): Response
  {
    return App::helper('response');
  }
}

if (!function_exists("router")) {
  function router(): Router
  {
    return App::helper('router');
  }
}

if (!function_exists("navigate")) {
  function navigate($name)
  {
    return App::helper('router')->navigate($name);
  }
}

if (!function_exists("db")) {
  function db(): Database
  {
    return App::helper('database');
  }
}
if (!function_exists("auth")) {
  function auth(): Auth
  {
    return App::helper('auth');
  }
}

if (!function_exists("middleware")) {
  function middleware(): MiddlewareServie
  {
    return App::helper('middleware');
  }
}

if (!function_exists("session")) {
  function session(): Session
  {
    return App::helper('session');
  }
}

if (!function_exists("view")) {
  function view($view, $props = [])
  {
    return App::helper('view')->render($view, $props);
  }
}
if (!function_exists("prepare")) {
  function prepare($sql)
  {
    return App::helper('database')->pdo->prepare($sql);
  }
}

if (!function_exists("dd")) {
  function dd(...$arg)
  {
    var_dump($arg);
    die;
  }
}
