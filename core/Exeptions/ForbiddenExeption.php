<?php

namespace Abd\Mvc\Exeptions;

class ForbiddenExeption extends \Exception
{
  protected $message = "You don't have access this page";
  protected $code = 403;
}
