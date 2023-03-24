<?php

class Database {
  private $host = 'localhost';
  private $user = '';
  private $password = '';
  private $database = '';
  private $connection;

  public function __construct() {
    $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database);

    if ($this->connection->connect_error) {
      die('Erro de conexão: ' . $this->connection->connect_error);
    }
  }

  public function query($sql) {
    return $this->connection->query($sql);
  }

  public function select($table, $fields, $where = '') {
    $sql = "SELECT $fields FROM $table";

    if (!empty($where)) {
      $sql .= " WHERE $where";
    }

    $result = $this->query($sql);

    if ($result->num_rows > 0) {
      return $result->fetch_all(MYSQLI_ASSOC);
    }

    return array();
  }
}
