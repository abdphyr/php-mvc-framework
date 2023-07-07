<?php

namespace Abd\Mvc\Middleware;
use Abd\Mvc\Request\Request;
use Abd\Mvc\Response\Response;

abstract class Middleware
{
  abstract public function handle(Request $request, Response $response, $callback, $next);
}
