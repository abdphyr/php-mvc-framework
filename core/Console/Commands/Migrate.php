<?php

use Abd\Mvc\Console\Contracts\Command;
use Abd\Mvc\Database\Migrator;

class Migrate implements Command
{
    public function run($ROOT_DIR, $argv)
    {
        Migrator::apply($ROOT_DIR);
    }
}
