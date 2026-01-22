<?php
declare(strict_types=1);

class TeacherController extends Controller
{
    public function dashboard(): void
    {
        Auth::requireRole('teacher');

        $user = $_SESSION['user']; // safe after requireRole
        $this->view('teacher/dashboard', ['user' => $user]);
    }
}
