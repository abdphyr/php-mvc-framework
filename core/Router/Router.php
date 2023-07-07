<?php

namespace Abd\Mvc\Router;

class Router
{
  public array $routes = [];

  public function resolve()
  {
    $callback = $this->routes[request()->method()][request()->route()] ?? false;

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
}
