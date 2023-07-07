<?php

namespace Abd\Mvc\Database;

class Migrator extends CreatePDO
{
  private static Migrator $migrator;

  public static function apply()
  {
    self::$migrator = new Migrator();
    self::$migrator->applyMigrations();
  }

  public function applyMigrations()
  {
    $this->createMigrationsTable();
    $appliedMigrations = $this->getAppliedMigrations();

    $newMigrations = [];
    $files = scandir(dirname(__DIR__) . '/../migrations');
    $toApplyMigrations = array_diff($files, $appliedMigrations);
    foreach ($toApplyMigrations as $migration) {
      if ($migration === '.' || $migration === '..') {
        continue;
      }
      require_once dirname(__DIR__) . "/../migrations/$migration";
      $classname = pathinfo($migration, PATHINFO_FILENAME);
      $instance = new $classname();
      $this->log("Applying migration $migration");
      $instance->up($this->pdo);
      $this->log("Applied migration $migration");
      $newMigrations[] = $migration;
    }
    if (!empty($newMigrations)) {
      $this->saveMigrations($newMigrations);
    } else {
      $this->log("All migrations applied");
    }
  }

  private function saveMigrations(array $migrations)
  {
    $str = implode(',', array_map(fn ($m) => "('$m')", $migrations));
    $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $str");
    $statement->execute();
  }

  private function getAppliedMigrations()
  {
    $statement = $this->pdo->prepare("SELECT migration FROM migrations");
    $statement->execute();
    return $statement->fetchAll(\PDO::FETCH_COLUMN);
  }

  private function createMigrationsTable()
  {
    $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
      id INT AUTO_INCREMENT PRIMARY KEY,
      migration VARCHAR(255),
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      ) ENGINE=INNODB;");
  }

  private function log($message)
  {
    echo '[' . date('Y-m-d H:i:s') . ']' . ' - ' . $message . PHP_EOL;
  }
}
