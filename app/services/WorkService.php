<?php
declare(strict_types=1);

class WorkService
{
    public function __construct(
        private WorkModel $workModel,
        private WorkAssignmentModel $assignmentModel,
        private StudentModel $studentModel
    ) {}

    public function createWork(int $teacherId, int $classId, string $title, ?string $description, ?array $file): array
    {
        $title = trim($title);
        if (mb_strlen($title) < 2) {
            return ['ok' => false, 'error' => 'Title is too short'];
        }

        // Optional file upload
        $filePath = null;
        if ($file && ($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
            if ($file['error'] !== UPLOAD_ERR_OK) {
                return ['ok' => false, 'error' => 'Upload failed'];
            }

            $allowed = ['pdf','png','jpg','jpeg','doc','docx','txt'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            if (!in_array($ext, $allowed, true)) {
                return ['ok' => false, 'error' => 'File type not allowed'];
            }

            $safeName = 'work_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;

            $uploadDir = __DIR__ . '/../../public/uploads/works/';
            if (!is_dir($uploadDir)) {
                return ['ok' => false, 'error' => 'Upload folder missing: public/uploads/works'];
            }

            $dest = $uploadDir . $safeName;
            if (!move_uploaded_file($file['tmp_name'], $dest)) {
                return ['ok' => false, 'error' => 'Could not save uploaded file'];
            }

            $filePath = 'uploads/works/' . $safeName; // relative to /public
        }

        $id = $this->workModel->create($classId, $title, $description, $filePath);
        return ['ok' => true, 'id' => $id];
    }

    public function listWorks(int $teacherId): array
    {
        return $this->workModel->findByTeacher($teacherId);
    }

    public function getWorkForTeacher(int $workId, int $teacherId): ?array
    {
        return $this->workModel->findOneForTeacher($workId, $teacherId);
    }

    public function listStudentsForClass(int $classId): array
    {
        return $this->studentModel->listByClass($classId);
    }

    public function assignWork(int $workId, array $studentIds): int
    {
        return $this->assignmentModel->assignMany($workId, $studentIds);
    }
}
