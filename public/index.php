<?php

use Abd\Mvc\App;

require_once __DIR__ . '/../vendor/autoload.php';

$kernel = new Abd\Mvc\Kernel\Kernel(dirname(__DIR__));

$app = App::boot($kernel);

require_once dirname(__DIR__) . "./core/helpers.php";

$app->load();

require_once dirname(__DIR__)."./routes/web.php";

$app->run();

$app->kill();