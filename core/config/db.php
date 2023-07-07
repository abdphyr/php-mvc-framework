<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../../');
$dotenv->load();

return $config = [
  'db' => [
    'dbhost' => $_ENV['DB_HOST'],
    'dbname' => $_ENV['DB_NAME'],
    'dbuser' => $_ENV['DB_USER'],
    'dbpassword' => $_ENV['DB_PASSWORD'],
    'dbport' => $_ENV['DB_PORT'],
    'dbconnection' => $_ENV['DB_CONNECTION']
  ]
];