<?php
declare(strict_types=1);

class WorkAssignmentModel
{
    public function __construct(private PDO $pdo) {}

    public function assignMany(int $workId, array $studentIds): int
    {
        if (empty($studentIds)) return 0;

        $stmt = $this->pdo->prepare("
            INSERT IGNORE INTO work_assignments (work_id, student_id)
            VALUES (:work_id, :student_id)
        ");

        $count = 0;
        foreach ($studentIds as $sid) {
            $stmt->execute(['work_id' => $workId, 'student_id' => (int)$sid]);
            $count += $stmt->rowCount(); // counts only new inserts
        }
        return $count;
    }
}
