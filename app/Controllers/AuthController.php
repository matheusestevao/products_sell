<?php

namespace App\Controllers;

class AuthController extends Controller
{
    public function login()
    {
        return $this->view('auth/login');
    }

    public function authenticate()
    {
        $where = ['email = ?', 'password = ?'];
        $params = [$_POST['email'], $_POST['password']];

        $validate = $this->db->read('users', $where, $params);

        if (!empty($validate)) {
            $_SESSION['authenticated'] = true;
            $_SESSION['user'] = $validate;

            header('Location: ' . URL_BASE . '/');
            exit;
        } else {
            return $this->view('auth/login', [
                'error' => 'Usuário ou senha inválidos'
            ]);
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        
        header('Location: /login');
    }
}
