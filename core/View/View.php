<?php

namespace Abd\Mvc\View;

use Abd\Mvc\Kernel\Kernel;

class View
{
  public string $title = 'Document';

  public function renderView($view, $params = [], ?string $layout = null)
  {
    $viewContent = self::renderOnlyView($view, $params);
    $layoutContent = self::layoutContent($layout);
    return str_replace('{{content}}', $viewContent, $layoutContent);
  }

  public function renderContent($content, ?string $layout)
  {
    $layoutContent = self::layoutContent($layout);
    return str_replace('{{content}}', $content, $layoutContent);
  }

  private function layoutContent(?string $layout)
  {
    ob_start();
    include_once Kernel::$ROOT_DIR . "/views/layouts/$layout.php";
    return ob_get_clean();
  }

  private function renderOnlyView($view, $params)
  {
    if (strpos($view, ".") !== false) {
      $view = str_replace(".", "/", $view);
    }
    foreach ($params as $key => $value) {
      $$key = $value;
    }

    ob_start();
    include_once Kernel::$ROOT_DIR . "/views/$view.php";
    return ob_get_clean();
  }
}
