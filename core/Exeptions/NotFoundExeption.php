<?php

namespace Abd\Mvc\Exeptions;

class NotFoundExeption extends \Exception
{
  protected $message = "Not found ";
  protected $code = 404;
}
