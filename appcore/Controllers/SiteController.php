<?php

namespace App\Controllers;

use App\Models\Contact;

class SiteController extends BaseController
{
  public function home()
  {
    return view('home', auth()->user());
  }

  public function contact()
  {
    return view('contact');
  }

  public function handleContact()
  {
    $isValidate = request()->validate([
      'subject' => 'required',
      'email' => 'required',
      'body' => 'required',
    ]);
    if ($isValidate) {
      return view('contact', [
        'model' => request()->body(),
        'errors' => request()->errors()
      ]);
    }
    $save = Contact::use()->save(request()->body());
    if($save) {
      session()->setFlash('success', "Message created successfully");
      response()->redirect('/');
    }
  }
}
