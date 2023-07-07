<?php

use app\core\database\Schema;

class m0002_add_password_column_to_users_table {
  public function up(\PDO $pdo)
  {
    // Schema
    // $sql = "ALTER TABLE user ADD COLUMN password VARCHAR(512) NOT NULL";
    // $pdo->exec($sql);
  }

  public function down(\PDO $pdo)
  {
    // $sql = "ALTER TABLE user DROP COLUMN password";
    // $pdo->exec($sql);
  }
}