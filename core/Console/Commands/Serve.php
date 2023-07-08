<?php

use Abd\Mvc\Console\Contracts\Command;

class Serve implements Command
{
    public $host = "localhost";
    public $port = "8000";
    public function run($ROOT_DIR, $argv)
    {
        foreach ($argv as $arg) {
            if(strpos('-', $arg) == 0) {
                $key = explode("=", $arg)[0];
                $value = explode("=", $arg)[1];
                if($key == "-p" || $key == "--port") {
                    $this->port = $value;
                }else if($key == "-h" || $key == "--host") {
                    $this->host = $value;
                }
            }
        }
        $host = $this->host;
        $port = $this->port;
        $path = $ROOT_DIR . "/public/index.php";
        $command = "php -S $host:$port $path";
        exec($command);
    }
}
