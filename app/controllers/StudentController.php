<?php

declare(strict_types=1);

class StudentController extends Controller
{
    public function dashboard(): void
    {
        Auth::requireRole('student');
        echo "Student dashboard OK";
    }
}
