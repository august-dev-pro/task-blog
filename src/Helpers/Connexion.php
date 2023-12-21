<?php

namespace August\Helpers;

use PDO;
use PDOException;

class Connexion
{
  private $pdo;

  public function __construct()
  {
    $dbHost = "localhost";
    $dbName = "blogin1_db";
    $dbUser = "root";
    $dbPassword = "";
    $charset = 'utf8';

    $this->connect($dbHost, $dbName, $dbUser, $dbPassword, $charset);
  }

  private function connect($host, $dbname, $username, $password, $charset)
  {
    $dsn = "mysql:host={$host};dbname={$dbname};charset={$charset}";

    try {
      $this->pdo = new PDO($dsn, $username, $password);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
  }

  public function getConnection()
  {
    return $this->pdo;
  }
}
