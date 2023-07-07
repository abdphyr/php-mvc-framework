<?php

namespace Abd\Mvc\Request;

use Abd\Mvc\Contracts\Request as ContractsRequest;
use Abd\Mvc\Validator\Validator;

class Request extends Validator implements ContractsRequest
{
  public function user()
  {
    return auth()->user();
  }

  public function params()
  {
    $routes = router()->routes[$this->method()];
    $path = $this->path();
    $myroute = [];
    $params = [];

    if (strpos($path, '?')) {
      $prm = substr($path, strpos($path, "?") + 1);
      foreach (explode('&', $prm) as $p) {
        $param = explode('=', $p);
        $params[$param[0]] = $param[1];
      }
      return $params;
    }

    foreach ($routes as $route => $callback) {
      $index = strpos($route, ':');
      if ($index) {
        $p = substr($path, 0, $index);
        $r = substr($route, 0, $index);
        if ($p === $r) {
          $myroute = explode('/', $route);
          break;
        }
      }
    }
    for ($i = 0; $i < count($myroute); $i++) {
      if (strpos($myroute[$i], ':') === 0) {
        $params[substr($myroute[$i], 1, strlen($myroute[$i]))] = explode('/', $path)[$i];
      }
    }
    return $params;
  }

  public function route()
  {
    $routes = router()->routes[$this->method()];
    $path = $this->path();

    if (strpos($path, '?')) {
      return substr($path, 0, strpos($path, '?'));
    }

    foreach ($routes as $route => $callback) {
      $index = strpos($route, ':');
      if ($index) {
        $p = substr($path, 0, $index);
        $r = substr($route, 0, $index);
        if ($p === $r) {
          return $route;
        }
      }
    }
    return $path;
  }

  public function path()
  {
    return  $_SERVER['REQUEST_URI'] ?? '/';
  }

  public function method()
  {
    return strtolower($_SERVER['REQUEST_METHOD']);
  }

  public function body()
  {
    $body = [];
    if ($this->method() === 'get') {
      foreach ($_GET as $key => $value) {
        $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      }
    }
    if ($this->method() === 'post') {
      foreach ($_POST as $key => $value) {
        $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      }
    }
    return $body;
  }
}
