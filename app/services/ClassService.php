<?php
declare(strict_types=1);

class ClassService
{
    public function __construct(private ClassModel $classModel) {}

    public function createClass(string $name, int $teacherId): array
    {
        $name = trim($name);

        if ($name === '' || mb_strlen($name) < 2) {
            return ['ok' => false, 'error' => 'Class name is too short'];
        }

        $id = $this->classModel->create($name, $teacherId);
        return ['ok' => true, 'id' => $id];
    }

    public function listTeacherClasses(int $teacherId): array
    {
        return $this->classModel->findByTeacher($teacherId);
    }
}
