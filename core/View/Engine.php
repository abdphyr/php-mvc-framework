<?php

namespace Abd\Mvc\View;

use Abd\Mvc\Kernel\Kernel;

abstract class Engine
{
    public $chars = [
        'quote' => "&#039;",
        'dquote' => "&quot;",
    ];
    public $template;

    public function loadView($view)
    {
        $content = $this->getViewFileContentsAsText($view);
        $content = $this->setLayout($content);
        $content = $this->conditions($content);
        $content = $this->foreach($content);
        $content = $this->for($content);
        $content = $this->php($content);
        $content = $this->setInterpolations($content);
        file_put_contents($this->template, html_entity_decode($content));
    }

    public function php($content)
    {
        $content = str_replace("@php", htmlentities("<?php "), $content);
        $content = str_replace("@endphp", htmlentities(" ?>"), $content);
        return $content;
    }
    public function foreach($content)
    {
        $i = 0;
        while ($i < 10000000000) {
            $start = strpos($content, "@foreach(", $i);
            $end = strpos($content, ")", $start);
            $slice = substr($content, $start + 9, $end - $start - 9);
            $html = htmlentities("<?php foreach(:f) : ?>");
            $html = str_replace(":f", $slice, $html);
            $slice = "@foreach(" . $slice . ")";
            $content = str_replace($slice, $html, $content);
            $i = $end;
            $hasNext = strpos($content, "@foreach(", $end);
            if (!$hasNext) {
                break;
            }
        }
        $content = str_replace("@endforeach", htmlentities("<?php endforeach ?>"), $content);
        return $content;
    }

    public function for($content)
    {
        $i = 0;
        while ($i < 10000000000) {
            $start = strpos($content, "@for(", $i);
            $end = strpos($content, ")", $start);
            $slice = substr($content, $start + 5, $end - $start - 5);
            $html = htmlentities("<?php for(:f) : ?>");
            $html = str_replace(":f", $slice, $html);
            $slice = "@for(" . $slice . ")";
            $content = str_replace($slice, $html, $content);
            $i = $end;
            $hasNext = strpos($content, "@for(", $end);
            if (!$hasNext) {
                break;
            }
        }
        $content = str_replace("@endfor", htmlentities("<?php endfor ?>"), $content);
        return $content;
    }

    public function conditions($content)
    {
        $i = 0;
        while ($i < 10000000000) {
            $start = strpos($content, "@if(", $i);
            $end = strpos($content, ")", $start);
            $slice = substr($content, $start + 4, $end - $start - 4);
            $html = htmlentities("<?php if (:if) : ?>");
            $html = str_replace(":if", $slice, $html);

            $slice = "@if(" . $slice . ")";
            $content = str_replace($slice, $html, $content);
            $i = $end;
            $hasNext = strpos($content, "@if(", $end);
            if (!$hasNext) {
                break;
            }
        }
        $content = str_replace("@else", htmlentities("<?php else : ?>"), $content);
        $content = str_replace("@endif", htmlentities("<?php endif ?>"), $content);
        return $content;
    }

    public function setLayout($content)
    {
        $startLayoutHead = strpos($content, "@layout", 0);
        $endLayoutHead = strpos($content, ")", $startLayoutHead);
        $layoutHeadBody = $this->slice($content, $startLayoutHead, $endLayoutHead);

        $startLayoutView = strpos($layoutHeadBody, "&#039;", $startLayoutHead);
        $endLayoutView = strpos($layoutHeadBody, "&#039;", $startLayoutView + 1);
        if ($startLayoutView == false && $endLayoutView == false) {
            $startLayoutView = strpos($layoutHeadBody, "&quot;", $startLayoutHead);
            $endLayoutView = strpos($layoutHeadBody, "&quot;", $startLayoutView + 1);
        }

        $startLayoutFooter = strpos($content, "@endlayout");

        $layoutViewName = $this->slice($layoutHeadBody, $startLayoutView + 6, $endLayoutView - 1);

        $slot = $this->slice($content, $endLayoutHead + 1, $startLayoutFooter - 1);
        $layoutContent = $this->getViewFileContentsAsText($layoutViewName);

        $content = str_replace("@slot", $slot, $layoutContent);
        return $content;
    }

    public function setInterpolations($content)
    {
        $i = 0;
        while ($i < 10000000000) {
            $start = strpos($content, "{", $i);
            $end = strpos($content, "}", $start);
            $slice = substr($content, $start + 2, $end - $start - 2);

            $html = htmlentities("<?php echo :val ?>");
            $html = str_replace(":val", $slice, $html);
            $slice = "{{" . $slice . "}}";
            $content = str_replace($slice, $html, $content);
            $i = $end;
            $hasNext = strpos($content, "{", $end);
            if (!$hasNext) {
                break;
            }
        }
        return $content;
    }

    public function getViewFileContentsAsText($view)
    {
        if (strpos($view, ".") !== false) {
            $view = str_replace(".", "/", $view);
        }
        $content = file_get_contents(Kernel::$ROOT_DIR . "/views/$view.php");
        $content = htmlspecialchars($content);
        return $content;
    }

    public function slice($content, $start, $end)
    {
        return substr($content, $start, ($end + 1) - $start);
    }
}
