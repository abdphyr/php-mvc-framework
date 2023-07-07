<?php

use Abd\Mvc\Database\Schema;

class m0001_create_users_table
{
  public function up()
  {
    $table = Schema::table('users');
    $table->column('firstname')->string(255);
    $table->column('lastname')->string(255);
    $table->column('email')->string(255);
    $table->column('password')->string(255);
    $table->column('info')->text()->nullable();
    $table->column('status')->number()->nullable();
    $table->created_at();
    $table->updated_at();
  }

  public function down(\PDO $pdo)
  {
    $sql = "DROP TABLE users;";
    $pdo->exec($sql);
  }
}
