<?php

namespace Abd\Mvc\Router;

class Router
{
  public array $routes = [];
  public array $names = [];
  public array $middlewares = [];

  public function resolve($route = null, $method = null)
  {
    $reMethod = $route ?? request()->method();
    $routeName = $method ?? request()->route();
    $callback = $this->routes[$reMethod][$routeName] ?? false;

    if ($callback === false) {
      response()->setStatusCode(404);
      return view("404");;
    }

    if (is_string($callback)) {
      return view($callback);
    }

    if (is_array($callback)) {
      return middleware()->check($callback);
    }
  }

  public function navigate($name)
  {
    if(isset($this->names[$name])) {
      return $this->names[$name];
    } else {
      dd("Route $name not found");
    }
  }
}
