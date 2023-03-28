<?php

namespace App\Classes;

class Helper
{
    protected static $db;

    public function __construct()
    {
        self::$db = new Database(DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    }

    public static function relationship(
        string $table,
        int $id
    )
    {
        $relationship = self::$db->read($table, ['id = ?'], [$id]);
        
        return $relationship[0];
    }
}