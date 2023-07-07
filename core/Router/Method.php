<?php

namespace Abd\Mvc\Router;

class Method
{
  public $method;
  public $route;
  public $callback;

  public function __construct($method, $route, $callback)
  {
    $this->method = $method;
    $this->route = $route;
    $this->callback = $callback;
    router()->routes[$method][$route] = $callback;
  }

  public function middleware($middleware)
  {
    router()->routes[$this->method][$this->route]['middleware'] = $middleware;
    return $this;
  }

  public function name($name)
  {
    router()->routes[$this->method][$this->route]['name'] = $name;
    return $this;
  }
}
