<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/ClassModel.php';
require_once __DIR__ . '/../services/ClassService.php';

class ClassController extends Controller
{
    private ClassService $service;

    public function __construct()
    {
        Auth::requireRole('teacher');

        $config = require __DIR__ . '/../../config/config.php';
        $pdo = Database::getInstance($config)->pdo();

        $model = new ClassModel($pdo);
        $this->service = new ClassService($model);
    }

    public function index(): void
    {
        $teacherId = (int)$_SESSION['user']['id'];
        $classes = $this->service->listTeacherClasses($teacherId);

        $this->view('teacher/classes/index', [
            'user' => $_SESSION['user'],
            'classes' => $classes,
            'flash' => $_SESSION['flash'] ?? null,
        ]);
        unset($_SESSION['flash']);
    }

    public function create(): void
    {
        $this->view('teacher/classes/create', [
            'user' => $_SESSION['user'],
            'error' => $_SESSION['flash_error'] ?? null,
        ]);
        unset($_SESSION['flash_error']);
    }

    public function store(): void
    {
        $teacherId = (int)$_SESSION['user']['id'];
        $name = $_POST['name'] ?? '';

        $res = $this->service->createClass($name, $teacherId);

        if (!$res['ok']) {
            $_SESSION['flash_error'] = $res['error'];
            $this->redirect('/teacher/classes/create');
        }

        $_SESSION['flash'] = 'Class created successfully';
        $this->redirect('/teacher/classes');
    }
}
