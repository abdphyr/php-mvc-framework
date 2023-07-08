<?php

namespace Abd\Mvc\Console;

class Kernel
{
    public $ROOT_DIR;
    public $commands = [];

    public function __construct($ROOT_DIR)
    {
        $this->ROOT_DIR = $ROOT_DIR;
    }

    public function loadCommands()
    {
        $commands = scandir(__DIR__ . '/Commands');
        foreach ($commands as $command) {
            if ($command === '.' || $command === '..') {
                continue;
            }
            $path = __DIR__ . "/Commands/$command";
            require_once $path;
            $class = pathinfo($path, PATHINFO_FILENAME);
            $this->commands[strtolower($class)] = new $class();
        }
    }

    public function options()
    {
        // p: => -p=3, p => p, p:: => p:89
        // port: => -port=3, port => port, port:: => port:89
        return getopt("p:h:", ["port:", "host:"]);
    }

    public function run($argv)
    {

        $this->loadCommands();
        if (count($argv) > 1) {
            $command = $argv[1];
            unset($argv[0]);
            unset($argv[1]);
            if (isset($this->commands[$command])) {
                $this->commands[$command]->run($this->ROOT_DIR, $argv);
            } else if ($command === 'list') {
                foreach ($this->commands as $key => $value) {
                    echo "\"php run " . $key ."\"" . "" . PHP_EOL;
                }
            } else {
                echo "\"$command\"" . " command not found" . PHP_EOL;
            }
        } else {
            $this->commands['serve']->run($this->ROOT_DIR, $argv);
        }
    }

    public function kill()
    {
        $this->commands = [];
    }
}
