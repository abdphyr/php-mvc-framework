<?php

namespace Abd\Mvc\View;

class View
{
  public $engines = [];

  public function __construct()
  {
    $this->loadEngines();
  }

  public function render($view, $props = [])
  {
    $this->engines['html']->loadView($view);
    $rendered = $this->engines['html']->render($props);
    $this->engines = [];
    return $rendered;
  }

  public function loadEngines()
  {
    $engines = scandir(__DIR__ . '/Engines');
    foreach ($engines as $engine) {
      if ($engine === '.' || $engine === '..') {
        continue;
      }
      $path = __DIR__ . "/Engines/$engine";
      require_once $path;
      $class = pathinfo($path, PATHINFO_FILENAME);
      $bindName = strtolower($class);
      $template = __DIR__ . "/templates/$bindName.php";
      $this->engines[$bindName] = new $class($template);
    }
  }
}
