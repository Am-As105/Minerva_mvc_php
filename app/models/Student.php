<?php




require_once 'User.php'; 

class Student extends User
{
    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM users WHERE role = 'student'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
