<?php
declare(strict_types=1);

class StudentModel
{
    public function __construct(private PDO $pdo) {}

    public function listByClass(int $classId): array
    {
        $stmt = $this->pdo->prepare("
            SELECT u.id, u.full_name AS name, u.email
            FROM class_students cs
            JOIN users u ON u.id = cs.student_id
            WHERE cs.class_id = :class_id AND u.role = 'student'
            ORDER BY u.full_name ASC
        ");
        $stmt->execute(['class_id' => $classId]);
        return $stmt->fetchAll();
    }
}
