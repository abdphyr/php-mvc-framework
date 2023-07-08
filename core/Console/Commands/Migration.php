<?php

use Abd\Mvc\Console\Contracts\Command;
use Abd\Mvc\Console\Traits\Pluralable;

class Migration implements Command
{
    use Pluralable;
    public function run($ROOT_DIR, $argv)
    {
        if(!isset($argv[2])) {
            echo "Enter migration name" . PHP_EOL;
            return;
        } else {
            $this->createMigration($ROOT_DIR, $argv[2]);
        }
    }

    public function createMigration($ROOT_DIR, $migration)
    {
        $path = $ROOT_DIR . "/db/migrations";
        $lowerPluralModelName = $this->plural($migration);
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

    public function template($file)
    {
        $file = dirname(__DIR__) . "/Templates/$file.stub";
        $text = file_get_contents($file);
        return $text;
    }
}
