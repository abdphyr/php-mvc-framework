<?php

use Abd\Mvc\App;
use Abd\Mvc\Auth\Auth;
use Abd\Mvc\Database\Database;
use Abd\Mvc\Middleware\MiddlewareServie;
use Abd\Mvc\Request\Request;
use Abd\Mvc\Response\Response;
use Abd\Mvc\Router\Router;

function request(): Request
{
  return App::helper('request');
}

function response(): Response
{
  return App::helper('response');
}

function router(): Router
{
  return App::helper('router');
}

function db(): Database
{
  return App::helper('database');
}

function auth(): Auth
{
  return App::helper('auth');
}

function middleware(): MiddlewareServie
{
  return App::helper('middleware');
}

function session()
{
  return App::helper('session');
}

function view($view, $params = [], $layout = 'main')
{
  return App::helper('view')->renderView($view, $params, $layout);
}

function prepare($sql)
{
  return App::helper('database')->pdo->prepare($sql);
}

function dd(...$arg)
{
  var_dump($arg);
  die;
}
