<?php
declare(strict_types=1);

class ClassModel
{
    public function __construct(private PDO $pdo) {}

    public function create(string $name, int $teacherId): int
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO classes (name, teacher_id)
            VALUES (:name, :teacher_id)
        ");
        $stmt->execute([
            'name' => $name,
            'teacher_id' => $teacherId,
        ]);

        return (int)$this->pdo->lastInsertId();
    }

    public function findByTeacher(int $teacherId): array
    {
        $stmt = $this->pdo->prepare("
            SELECT id, name, created_at
            FROM classes
            WHERE teacher_id = :teacher_id
            ORDER BY created_at DESC
        ");
        $stmt->execute(['teacher_id' => $teacherId]);
        return $stmt->fetchAll();
    }
}
