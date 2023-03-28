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
        $where = ['email = ?'];
        $params = [$_POST['email']];

        $validate = $this->db->read('users', $where, $params);

        if (!empty($validate)) {
            if(password_verify($_POST['password'], $validate[0]['password'])) {
                $_SESSION['authenticated'] = true;
                $_SESSION['user'] = $validate;

                header('Location: ' . URL_BASE . '/');
                exit;
            }
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
