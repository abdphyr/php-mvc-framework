<?php
namespace App\Models;

class Contact extends BaseModel
{
  protected $fillable = ['subject', 'email', 'body'];
  protected $table = 'contacts';

  public static function use()
  {
    return new Contact();
  }

}
