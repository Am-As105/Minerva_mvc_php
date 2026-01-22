<?php

class ClassRoom {
    protected string $name;
    protected array $students = [];

    public function __construct($name) {
        $this->name = $name;
    }

    public function addStudent(Student $student) {
        $this->students[] = $student;
    }

    public function getStudents() {
        return $this->students;
    }

    public function getName() { return $this->name; }
}
