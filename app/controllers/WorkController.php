<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/WorkModel.php';
require_once __DIR__ . '/../models/StudentModel.php';
require_once __DIR__ . '/../models/WorkAssignmentModel.php';
require_once __DIR__ . '/../services/WorkService.php';
require_once __DIR__ . '/../models/ClassModel.php';
require_once __DIR__ . '/../services/ClassService.php';

class WorkController extends Controller
{
    private WorkService $service;
    private ClassService $classService;

    public function __construct()
    {
        Auth::requireRole('teacher');

        $config = require __DIR__ . '/../../config/config.php';
        $pdo = Database::getInstance($config)->pdo();

        $this->service = new WorkService(
            new WorkModel($pdo),
            new WorkAssignmentModel($pdo),
            new StudentModel($pdo)
        );

        $this->classService = new ClassService(new ClassModel($pdo));
    }

    public function index(): void
    {
        $teacherId = (int)$_SESSION['user']['id'];
        $works = $this->service->listWorks($teacherId);

        $this->view('teacher/works/index', [
            'user' => $_SESSION['user'],
            'works' => $works,
            'flash' => $_SESSION['flash'] ?? null,
        ]);
        unset($_SESSION['flash']);
    }

    public function create(): void
    {
        $teacherId = (int)$_SESSION['user']['id'];
        $classes = $this->classService->listTeacherClasses($teacherId);

        $this->view('teacher/works/create', [
            'user' => $_SESSION['user'],
            'classes' => $classes,
            'error' => $_SESSION['flash_error'] ?? null,
        ]);
        unset($_SESSION['flash_error']);
    }

    public function store(): void
    {
        $teacherId = (int)$_SESSION['user']['id'];

        $classId = (int)($_POST['class_id'] ?? 0);
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? null;

        $res = $this->service->createWork($teacherId, $classId, $title, $description, $_FILES['file'] ?? null);

        if (!$res['ok']) {
            $_SESSION['flash_error'] = $res['error'];
            $this->redirect('/teacher/works/create');
        }

        $_SESSION['flash'] = 'Work created. Now assign it to students.';
        $this->redirect('/teacher/works/assign?work_id=' . $res['id']);
    }

    public function assign(): void
    {
        $teacherId = (int)$_SESSION['user']['id'];
        $workId = (int)($_GET['work_id'] ?? 0);

        $work = $this->service->getWorkForTeacher($workId, $teacherId);
        if (!$work) {
            http_response_code(404);
            echo "Work not found";
            return;
        }

        $students = $this->service->listStudentsForClass((int)$work['class_id']);

        $this->view('teacher/works/assign', [
            'user' => $_SESSION['user'],
            'work' => $work,
            'students' => $students,
            'flash' => $_SESSION['flash'] ?? null,
            'error' => $_SESSION['flash_error'] ?? null,
        ]);
        unset($_SESSION['flash'], $_SESSION['flash_error']);
    }

    public function saveAssignment(): void
    {
        $teacherId = (int)$_SESSION['user']['id'];
        $workId = (int)($_POST['work_id'] ?? 0);

        $work = $this->service->getWorkForTeacher($workId, $teacherId);
        if (!$work) {
            http_response_code(404);
            echo "Work not found";
            return;
        }

        $studentIds = $_POST['student_ids'] ?? [];
        if (!is_array($studentIds) || empty($studentIds)) {
            $_SESSION['flash_error'] = 'Select at least one student';
            $this->redirect('/teacher/works/assign?work_id=' . $workId);
        }

        $added = $this->service->assignWork($workId, $studentIds);
        $_SESSION['flash'] = "Assigned to {$added} student(s).";
        $this->redirect('/teacher/works');
    }
}
