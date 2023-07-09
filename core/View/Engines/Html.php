<?php

use Abd\Mvc\View\Engine;
use Abd\Mvc\View\Contracts\Engine as EngineInterface;

class Html extends Engine implements EngineInterface
{
    public function __construct($template)
    {
        $this->template = $template;
    }

    public function render($props)
    {
        foreach ($props as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once $this->template;
        return ob_get_clean();
    }
}
