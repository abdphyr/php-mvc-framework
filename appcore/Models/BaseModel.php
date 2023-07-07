<?php

namespace App\Models;

use Abd\Mvc\Model\Model;

class BaseModel extends Model
{
  protected $fillable = ['subject', 'email', 'body'];
  protected $table = 'contacts';

  public static function use()
  {
    return new Contact();
  }

}
