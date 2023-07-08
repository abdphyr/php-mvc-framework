<?php

use Abd\Mvc\Console\Contracts\Command;
use Abd\Mvc\Console\Traits\Pluralable;

class Model implements Command
{
    use Pluralable;
    public function run($ROOT_DIR, $argv)
    {
        if (!isset($argv[2])) {
            echo "Enter model name" . PHP_EOL;
            return;
        } else {
            $this->createModel($ROOT_DIR, $argv[2]);
        }
        if (isset($argv[3])) {
            $ops = $argv[3];
            if (strpos('-', $ops) == 0) {
                $arr = str_split($ops);
                unset($arr[0]);
                foreach ($arr as $option) {
                    switch ($option) {
                        case "m":
                            $this->createMigration($ROOT_DIR, $argv[2]);
                            break;
                        case "c":
                            $this->createController($ROOT_DIR, $argv[2]);
                            break;
                    }
                }
            }
        }
    }

    public function createController($ROOT_DIR, $model)
    {
        $path = $ROOT_DIR . "/appcore/Controllers";
        $file = $path . "/" . $model . "Controller" . ".php";
        if (file_exists($file)) {
            echo  "\"" . $model . "Controller" . ".php\"" . " is already exist" . PHP_EOL;
            return;
        }
        $resource = fopen($file, "c");
        $text = $this->template("controller");
        $text = str_replace("Template", $model . "Controller", $text);
        fwrite($resource, $text);
        fclose($resource);
        echo "Create $model.php" . PHP_EOL;
    }
    
    public function createMigration($ROOT_DIR, $model)
    {
        $path = $ROOT_DIR . "/db/migrations";
        $lowerPluralModelName = $this->plural(strtolower($model));
        $name = "m" . date("Y_m_d_h_m") . "_create_" . $lowerPluralModelName . "_migration";
        $file = $path . "/" . $name  . ".php";

        if (file_exists($file)) {
            echo  "\"$name.php\"" . " is already exist" . PHP_EOL;
            return;
        }
        $resource = fopen($file, "c");
        $text = $this->template("migration");
        $text = str_replace("migration", $lowerPluralModelName, $text);
        $text = str_replace("name", $name, $text);
        fwrite($resource, $text);
        fclose($resource);
        echo "Create $name" . PHP_EOL;
    }
    public function createModel($ROOT_DIR, $model)
    {
        $path = $ROOT_DIR . "/appcore/Models";
        $file = $path . "/" . $model . ".php";
        if (file_exists($file)) {
            echo  "\"" . $model . ".php\"" . " is already exist" . PHP_EOL;
            return;
        }
        $resource = fopen($file, "c");
        $text = $this->template("model");
        $text = $this->replacer($text, $model);
        fwrite($resource, $text);
        fclose($resource);
        echo "Create $model.php" . PHP_EOL;
    }

    public function replacer($text, $name)
    {
        $text = str_replace("Template", $name, $text);
        $pluralName = $this->plural($name);
        $text = str_replace("template", $pluralName, $text);
        return $text;
    }

    public function template($file)
    {
        $file = dirname(__DIR__) . "/Templates/$file.stub";
        $text = file_get_contents($file);
        return $text;
    }
}
