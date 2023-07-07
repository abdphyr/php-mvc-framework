<?php

namespace Abd\Mvc\Auth;

class Auth
{
  public static function user()
  {
    $primaryValue = session()->get('user');
    if ($primaryValue) {
      $statement = prepare("SELECT * FROM users WHERE id = $primaryValue");
      $statement->execute();
      return $statement->fetchObject();
    }
    return false;
  }
}
