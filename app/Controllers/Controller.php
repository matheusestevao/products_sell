<?php

namespace App\Controllers;

use App\Classes\Database;

class Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database(DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    }

    protected function view($view, $data = [])
    {
        extract($data);
        
        require_once "views/$view.php";
    }

    protected function redirect($url)
    {
        header("Location: $url");
        exit;
    }

    protected function model($model)
    {
        require_once "models/$model.php";

        return new $model();
    }
}