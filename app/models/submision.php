<?php

class Work {
    protected int $id;
    protected string $title;
    protected string $description;
    protected int $classId;
    protected string $createdAt;

    public function __construct($title, $description, $classId) {
        $this->title = $title;
        $this->description = $description;
        $this->classId = $classId;
        $this->createdAt = date("Y-m-d H:i:s");
    }

    public function getTitle() { return $this->title; }
    public function getDescription() { return $this->description; }
    public function getClassId() { return $this->classId; }
    public function getCreatedAt() { return $this->createdAt; }
}
