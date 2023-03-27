<?php

namespace App\Classes;

class Database 
{
	private $pdo;
    
    public function __construct(
        string $host, 
        string $dbname, 
        string $username, 
        string $password
    )
    {
        try {
            $this->pdo = new \PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Database error connection: " . $e->getMessage());
        }
    }
    
    public function read(
        string $table, 
        ?array $where = [], 
        ?array $params = []
    ): ?array
    {
        $query = "SELECT * FROM $table";

        if (!empty($where)) {
            $query .= " WHERE " . implode(' AND ', $where);
        }
        
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);

        error_log($stmt->queryString);
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function create($table, $data)
    {
        $keys = array_keys($data);
        $values = array_values($data);
        $placeholders = str_repeat('?,', count($keys) - 1) . '?';
        
        $stmt = $this->pdo->prepare("INSERT INTO $table (" . implode(',', $keys) . ") VALUES ($placeholders)");
        
        foreach ($values as $index => $value) {
            $stmt->bindValue($index + 1, $value);
        }
        
        return $stmt->execute();
    }
    
    public function update(
        string $table, 
        array $data, 
        int $id
    )
    {
        $fields = '';
        
        foreach ($data as $key => $value) {
            $fields .= "$key = ?,";
        }
        
        $fields = rtrim($fields, ',');
        
        $stmt = $this->pdo->prepare("UPDATE $table SET $fields WHERE id = ?");
        
        $values = array_values($data);
        $values[] = $id;
        
        foreach ($values as $index => $value) {
            $stmt->bindValue($index + 1, $value);
        }
        
        return $stmt->execute();
    }
    
    public function delete(string $table, int $id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM $table WHERE id = ?");
        $stmt->bindValue(1, $id);

        return $stmt->execute();
    }
    
    public function getPdo()
    {
        return $this->pdo;
    }
}
