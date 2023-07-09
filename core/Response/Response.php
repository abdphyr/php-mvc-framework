<?php

namespace Abd\Mvc\Response;

class Response
{
  public function setStatusCode(int $code)
  {
    http_response_code($code);
  }
  public function redirect(string $url)
  {
    header('Location: ' . $url);
  }

  public function json($data, $status = 200)
  {
    $this->setStatusCode($status);
    header("Content-Type: application/json");
    return json_encode($data);
  }
}
