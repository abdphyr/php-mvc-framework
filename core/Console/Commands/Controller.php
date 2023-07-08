<?php

use Abd\Mvc\Console\Contracts\Command;

class Controller implements Command
{
    public function run($ROOT_DIR, $argv)
    {
        if(!isset($argv[2])) {
            echo "Enter migration name" . PHP_EOL;
            return;
        } else {
            $this->createController($ROOT_DIR, $argv[2]);
        }
    }

    public function createController($ROOT_DIR, $controller)
    {
        $path = $ROOT_DIR . "/appcore/Controllers";
        $file = $path . "/" . $controller . ".php";
        if (file_exists($file)) {
            echo  "\"" . $controller . ".php\"" . " is already exist" . PHP_EOL;
            return;
        }
        $resource = fopen($file, "c");
        $text = $this->template("controller");
        $text = str_replace("Template", $controller, $text);
        fwrite($resource, $text);
        fclose($resource);
        echo "Create $controller.php" . PHP_EOL;
    }

    public function template($file)
    {
        $file = dirname(__DIR__) . "/Templates/$file.stub";
        $text = file_get_contents($file);
        return $text;
    }
}
