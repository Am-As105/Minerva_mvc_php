<?php

declare(strict_types=1);

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../services/AuthService.php';

class AuthController extends Controller
{
    private AuthService $auth;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/config.php';
        $pdo = Database::getInstance($config)->pdo();
        $userModel = new User($pdo);
        $this->auth = new AuthService($userModel);
    }

    public function showLogin(): void
    {
        $this->view('auth/login', [
            'error' => $_SESSION['flash_error'] ?? null
        ]);
        unset($_SESSION['flash_error']);
    }

    public function login(): void
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $result = $this->auth->attempt($email, $password);

        if (!$result['ok']) {
            $_SESSION['flash_error'] = $result['error'];
            $this->redirect('/login');
        }

        // role redirect
        if ($result['role'] === 'teacher') {
            $this->redirect('/teacher/dashboard');
        }

        $this->redirect('/student/dashboard');
    }

    public function logout(): void
    {
        session_destroy();
        $this->redirect('/login');
    }
}
