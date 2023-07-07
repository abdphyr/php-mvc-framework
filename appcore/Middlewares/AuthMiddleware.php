<?php

namespace App\Middlewares;

use Abd\Mvc\Exeptions\ForbiddenExeption;
use Abd\Mvc\Middleware\Middleware;
use Abd\Mvc\Request\Request;
use Abd\Mvc\Response\Response;

class AuthMiddleware extends Middleware
{
  public function handle(Request $request, Response $response, $callback, $next)
  {
    if (!$request->user()) {
      $exeption = new ForbiddenExeption();
      $response->setStatusCode(403);
      return view('unauthorized', ['exeption' => $exeption], 'auth');
    }
    return $next($callback);
  }
}
