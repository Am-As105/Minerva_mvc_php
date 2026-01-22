<?php
declare(strict_types=1);

class Controller
{
    protected function view(string $viewPath, array $data = []): void
    {
        extract($data);
        $file = __DIR__ . '/../views/' . $viewPath . '.php';
        if (!file_exists($file)) {
            http_response_code(500);
            echo "View not found: " . htmlspecialchars($viewPath);
            return;
        }
        require $file;
    }

    protected function redirect(string $path): void
{
    // If app is inside /pppppp/public, prefix automatically
    if (defined('BASE_URL') && str_starts_with($path, '/')) {
        $path = BASE_URL . $path;
    }

    header("Location: {$path}");
    exit;
}

}
