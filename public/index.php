<?php
declare(strict_types=1);

session_start();
$base = rtrim(str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']), '/');
define('BASE_URL', $base);
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/core/Controller.php';

require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/TeacherController.php';
require_once __DIR__ . '/../app/controllers/StudentController.php';

require_once __DIR__ . '/../app/core/Auth.php';

require_once __DIR__ . '/../app/controllers/ClassController.php';

require_once __DIR__ . '/../app/controllers/WorkController.php';


$router = new Router();

$router->get('/', fn() => header('Location: /login') ?: exit);

$router->get('/login', [AuthController::class, 'showLogin']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

$router->post('/', [AuthController::class, 'login']);
$router->post('/index.php', [AuthController::class, 'login']);


$router->get('/teacher/dashboard', [TeacherController::class, 'dashboard']);
$router->get('/student/dashboard', [StudentController::class, 'dashboard']);

$router->get('/teacher/classes', [ClassController::class, 'index']);
$router->get('/teacher/classes/create', [ClassController::class, 'create']);
$router->post('/teacher/classes/create', [ClassController::class, 'store']);

$router->get('/teacher/works', [WorkController::class, 'index']);
$router->get('/teacher/works/create', [WorkController::class, 'create']);
$router->post('/teacher/works/create', [WorkController::class, 'store']);

$router->get('/teacher/works/assign', [WorkController::class, 'assign']);
$router->post('/teacher/works/assign', [WorkController::class, 'saveAssignment']);


$router->dispatch();
