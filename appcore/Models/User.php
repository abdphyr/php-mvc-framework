<?php

namespace App\Models;

class User extends BaseModel
{
  protected $fillable = ['firstname', 'lastname', 'email', 'password', 'status'];
  protected $table = 'users';

  public static function use()
  {
    return new User();
  }

  public function register($reqBody)
  {
    $reqBody['status'] = 0;
    $reqBody['password'] = password_hash($reqBody['password'], PASSWORD_DEFAULT);
    return $this->save($reqBody);
  }

  public function login($reqBody)
  {
    $user = $this->findOne(['email' => $reqBody['email']]);
    if (!$user) {
      session()->setFlash('login', 'User doesn\'t exist this email');
      return false;
    }
    if (!password_verify($reqBody['password'], $user->password)) {
      session()->setFlash('login', 'Password is incorrect');
      return false;
    }
    session()->set('user', $user->id);
    return true;
  }
}
