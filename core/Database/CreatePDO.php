<?php

namespace Abd\Mvc\Database;

abstract class CreatePDO
{
  public \PDO $pdo;

  public function __construct()
  {
    $configAll = require dirname(__DIR__) . '/config/db.php';
    $config = $configAll['db'];
    $dbconnection = $config['dbconnection'] ?? '';
    $dbhost = $config['dbhost'] ?? '';
    $dbport = $config['dbport'] ?? '';
    $dbname = $config['dbname'] ?? '';
    $dbuser = $config['dbuser'] ?? '';
    $dbpassword = $config['dbpassword'] ?? '';
    $this->pdo = new \PDO("$dbconnection:host=$dbhost;port=$dbport;dbname=$dbname", $dbuser, $dbpassword);
    $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
  }
}
