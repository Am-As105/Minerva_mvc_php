<?php
require_once "Student.php";
require_once "ClassRoom.php";

class Attendance {
    protected Student $student;
    protected ClassRoom $class;
    protected string $date;
    protected bool $present;

    public function __construct(Student $student, ClassRoom $class, bool $present) {
        $this->student = $student;
        $this->class = $class;
        $this->present = $present;
        $this->date = date("Y-m-d");
    }

    public function isPresent() { return $this->present; }
    public function getStudent() { return $this->student; }
    public function getClass() { return $this->class; }
    public function getDate() { return $this->date; }
}
