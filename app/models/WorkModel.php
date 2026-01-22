<?php
declare(strict_types=1);

class WorkModel
{
    public function __construct(private PDO $pdo) {}

    public function create(int $classId, string $title, ?string $description, ?string $filePath): int
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO works (class_id, title, description, file_path)
            VALUES (:class_id, :title, :description, :file_path)
        ");
        $stmt->execute([
            'class_id' => $classId,
            'title' => $title,
            'description' => $description,
            'file_path' => $filePath,
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    public function findByTeacher(int $teacherId): array
    {
        $stmt = $this->pdo->prepare("
            SELECT w.id, w.title, w.description, w.file_path, w.created_at,
                   c.id AS class_id, c.name AS class_name
            FROM works w
            JOIN classes c ON c.id = w.class_id
            WHERE c.teacher_id = :teacher_id
            ORDER BY w.created_at DESC
        ");
        $stmt->execute(['teacher_id' => $teacherId]);
        return $stmt->fetchAll();
    }

    public function findOneForTeacher(int $workId, int $teacherId): ?array
    {
        $stmt = $this->pdo->prepare("
            SELECT w.id, w.title, w.description, w.file_path, w.created_at,
                   c.id AS class_id, c.name AS class_name
            FROM works w
            JOIN classes c ON c.id = w.class_id
            WHERE w.id = :work_id AND c.teacher_id = :teacher_id
            LIMIT 1
        ");
        $stmt->execute(['work_id' => $workId, 'teacher_id' => $teacherId]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function countAssignments(int $workId): int
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS n FROM work_assignments WHERE work_id = :id");
        $stmt->execute(['id' => $workId]);
        return (int)($stmt->fetch()['n'] ?? 0);
    }
}
