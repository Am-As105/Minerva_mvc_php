<?php
declare(strict_types=1);

class AuthService
{
    public function __construct(private User $userModel) {}

    public function attempt(string $email, string $password): array
    {
        $email = trim(strtolower($email));
        $user = $this->userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            return ['ok' => false, 'error' => 'Identifiants invalides'];
        }

        // session payload
        $_SESSION['user'] = [
            'id' => (int)$user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
        ];

        return ['ok' => true, 'role' => $user['role']];
    }

    public function logout(): void
    {
        unset($_SESSION['user']);
        session_regenerate_id(true);
    }

    public function user(): ?array
    {
        return $_SESSION['user'] ?? null;
    }
}
