<?php

namespace Abd\Mvc\View;

use Abd\Mvc\Kernel\Kernel;
use DOMDocument;

class View
{
  public string $title = 'Document';

  public function renderView($view, $params = [], ?string $layout = null)
  {
    $viewContent = self::renderOnlyView($view, $params);
    $layoutContent = self::layoutContent($layout);
    $content = str_replace('{{content}}', $viewContent, $layoutContent);
    // $content = htmlentities($viewContent);
    $content = $this->navigate($content);
    // $content = $this->if($content);
    // $dom = new DOMDocument();
    // $dom->loadHTML($content);
    // var_dump($dom->saveHTML());die;
    return ($content);
    // return html_entity_decode($content);
  }
  
  public function if($content)
  {
    $start = 0;
    while ($start < 100) {
      $ifStart = strpos($content, "@if(", $start);
      // var_dump($ifStart, substr($content, $ifStart));die;
      if (!$ifStart) {
        break;
      }
      $start = $ifStart;
      // $start = $ifStart + 3;
      $ifEnd = strpos($content, ")", $ifStart);
      // var_dump($ifEnd, substr($content, $ifEnd + 1));die;
      $ifBody = substr($content, $ifStart, $ifEnd - $ifStart + 1);
      $if = substr($content, $ifStart + 4, $ifEnd - $ifStart - 5);
      // var_dump($if);die;
      $html = htmlentities("<?php if (:if) : ?>");
      $html = str_replace(":if", $if, $html);
      $content = str_replace("$ifBody", $html, $content);
        // var_dump($content);die;

      $nextIf = strpos($content, "@if(", $ifStart);
      // var_dump($nextIf, substr($content, $nextIf));die;
      if (!$nextIf) {
        break;
      }
    }
    $content = str_replace("@else", htmlentities("<?php else : ?>"), $content);
    $content = str_replace("@endif", htmlentities("<?php endif ?>"), $content);
    // var_dump($content);die;
    return $content;
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
    if(is_array($params) || is_object($params)) {
      foreach ($params as $key => $value) {
        $$key = $value;
      }
    }

    ob_start();
    include_once Kernel::$ROOT_DIR . "/views/$view.php";
    return ob_get_clean();
  }


  public function navigate($content)
  {
    $start = 0;
    foreach (router()->names as $name => $path) {
      $fnStart = strpos($content, "{{navigate", $start);
      $start = $fnStart + 3;
      $fnEnd = strpos($content, "}", $fnStart + 1);
      $routeStart = strpos($content, "'", $fnStart);
      $routeEnd = strpos($content, "'", $routeStart + 1);
      $route = substr($content, $routeStart + 1, $routeEnd - $routeStart - 1);
      $url = router()->navigate($route);
      $content = str_replace("{{navigate('$route')}}", $url, $content);
    }
    return $content;
  }
}
