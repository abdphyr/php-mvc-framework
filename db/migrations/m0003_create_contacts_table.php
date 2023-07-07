<?php

use Abd\Mvc\Database\Schema;

class m0003_create_contacts_table
{
  public function up()
  {
    $table = Schema::table('contacts');
    $table->column('subject')->string(255);
    $table->column('email')->string(255);
    $table->column('body')->text();
    $table->created_at();
    $table->updated_at();
  }

  public function down(\PDO $pdo)
  {
    $sql = "DROP TABLE contacts;";
    $pdo->exec($sql);
  }
}
