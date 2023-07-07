<?php

namespace Abd\Mvc\Database;

class Schema extends CreatePDO
{
  private static Schema $schema;
  private string $tablename;

  private function __construct($tablename)
  {
    $this->tablename = $tablename;
    parent::__construct();
  }

  public static function table($tablename)
  {
    self::$schema = new Schema($tablename);

    self::$schema->pdo->exec("CREATE TABLE IF NOT EXISTS $tablename (
      id INT AUTO_INCREMENT PRIMARY KEY
    ) ENGINE=INNODB;");
    return self::$schema;
  }

  public function column($column)
  {
    return new Column($this->tablename, $column, $this->pdo);
  }

  public function created_at()
  {
    $sql = "ALTER TABLE $this->tablename ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
    $this->pdo->exec($sql);
  }

  public function updated_at()
  {
    $sql = "ALTER TABLE $this->tablename ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
    $this->pdo->exec($sql);
  }
}
