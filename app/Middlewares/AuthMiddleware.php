<?php

namespace App\Middlewares;

class AuthMiddleware 
{
    private $notValidate = [
        '/login', 
        '/',
        '/authenticate'
    ];

    public function handle()
    {
        if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            return;
        }
    
        $currentRoute = $_SERVER['REQUEST_URI'];

        if (in_array($currentRoute, $this->notValidate)) {
            return;
        }
    
        header('Location: /login');
        exit;
    }
}
