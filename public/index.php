<?php


error_reporting(E_ERROR | E_PARSE);
require_once __DIR__ . '/../vendor/autoload.php';

$kernel = new Abd\Mvc\Kernel\Kernel(dirname(__DIR__));

$app = new Abd\Mvc\App($kernel);

require_once dirname(__DIR__) . "/core/helpers.php";

$app->load();

require_once dirname(__DIR__) . "/routes/web.php";
$app->run();

$app->end();