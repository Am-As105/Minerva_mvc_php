<?php
declare(strict_types=1);

class Router
{
    private array $routes = ['GET' => [], 'POST' => []];
    private string $basePath;

    public function __construct(?string $basePath = null)
    {
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? ''; // /classroom-app/public/index.php
        $this->basePath = $basePath ?? rtrim(str_replace('/index.php', '', $scriptName), '/');
    }

    public function get(string $path, callable|array $handler): void
    {
        $this->routes['GET'][$this->norm($path)] = $handler;
    }

    public function post(string $path, callable|array $handler): void
    {
        $this->routes['POST'][$this->norm($path)] = $handler;
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';

        if ($this->basePath !== '' && str_starts_with($path, $this->basePath)) {
            $path = substr($path, strlen($this->basePath));
            if ($path === '') $path = '/';
        }

        $path = $this->norm($path);
        $handler = $this->routes[$method][$path] ?? null;

        if (!$handler) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        if (is_array($handler)) {
            [$class, $action] = $handler;
            $controller = new $class();
            $controller->$action();
            return;
        }

        call_user_func($handler);
    }

    private function norm(string $path): string
    {
        $path = '/' . ltrim($path, '/');
        return rtrim($path, '/') ?: '/';
    }
}
