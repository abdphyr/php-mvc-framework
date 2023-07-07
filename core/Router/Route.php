<?php

namespace Abd\Mvc\Router;

class Route
{
  public static function get($route, $callback)
  {
    return new Method('get', $route, $callback);
  }

  public static function post($route, $callback)
  {
    return new Method('post', $route, $callback);
  }

  public static function put($route, $callback)
  {
    return new Method('put', $route, $callback);
  }

  public static function patch($route, $callback)
  {
    return new Method('patch', $route, $callback);
  }

  public static function delete($route, $callback)
  {
    return new Method('delete', $route, $callback);
  }
}
