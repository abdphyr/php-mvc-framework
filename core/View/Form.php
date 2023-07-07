<?php

namespace Abd\Mvc\View;

class Form
{
  public static function begin($action, $method)
  {
    echo sprintf('<form action="%s" method="%s">', $action, $method);
    return new Form();
  }

  public static function end()
  {
    echo '</form>';
  }

  public function field($errors, $model, $attribute)
  {
    return new Field($errors, $model, $attribute);
  }
}
