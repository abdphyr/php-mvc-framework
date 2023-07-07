<?php

namespace Abd\Mvc\Middleware;

class MiddlewareServie
{
  public $middlewares;

  public function __construct()
  {
    $this->middlewares = [];
  }

  public function registerMiddleware($key, $class)
  {
    $this->middlewares[$key] = $class;
  }

  public function registerMiddlewares($middlewares)
  {
    $this->middlewares = $middlewares;
  }

  public function next()
  {
    return fn ($callback) => call_user_func($callback, request(), response());
  }

  public function useMiddleware($middKey, $callback)
  {
    if(isset($this->middlewares[$middKey])) {
      $middleware = new $this->middlewares[$middKey]();
    }
    if ($middleware) {
      return $middleware->handle(
        request(),
        response(),
        $callback,
        $this->next()
      );
    }
  }

  public function check($callback)
  {
    $mycallback = [new $callback[0](), $callback[1]];

    $middlewares = $callback['middleware'];

    if ($middlewares) {
      if (is_string($middlewares)) {
        return $this->useMiddleware($middlewares, $mycallback);
      }
      if (is_array($middlewares)) {
        foreach ($middlewares as $middKey) {
          $handle =  $this->useMiddleware($middKey, $mycallback);
          if (is_string($handle)) {
            return $handle;
          }
        }
        return call_user_func($mycallback, request(), response());
      }
    }

    if (!empty($mycallback[0]->middlewares)) {
      foreach ($mycallback[0]->middlewares as $middKey => $action) {

        if (is_numeric($middKey)) {
          return $this->useMiddleware($action, $mycallback);
        }

        if (is_array($action)) {
          foreach ($action as $act) {
            if ($mycallback[1] === $act) {
              return $this->useMiddleware($middKey, $mycallback);
            }
          }
        }

        if ($mycallback[1] === $action) {
          return $this->useMiddleware($middKey, $mycallback);
        }
      }
    }
    return call_user_func($mycallback, request(), response());
  }
}
