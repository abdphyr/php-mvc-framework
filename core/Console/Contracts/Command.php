<?php

namespace Abd\Mvc\Console\Contracts;

interface Command
{
    public function run($ROOT_DIR, $argv);
}
