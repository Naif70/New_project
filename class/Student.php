<?php 
require_once ("class/DBController.php");

class Student
{
    private $db_handle;
    private $role;

    function __construct($role = 'viewer') {
        $this->db_handle = new DBController();
        $this->role = $role;
    }

    function addStudent($name, $roll_number, $dob, $class) {
        if($this->role != 'admin') { die("❌ لا تملك صلاحية إضافة الطلاب"); }
        $query = "INSERT INTO tbl_student (name,roll_number,dob,class) VALUES (?, ?, ?, ?)";
        $paramType = "siss";
        $paramValue = array($name, $roll_number, $dob, $class);
        return $this->db_handle->insert($query, $paramType, $paramValue);
    }

    function editStudent($name, $roll_number, $dob, $class, $student_id) {
        if($this->role != 'admin') { die("❌ لا تملك صلاحية تعديل الطلاب"); }
        $query = "UPDATE tbl_student SET name = ?,roll_number = ?,dob = ?,class = ? WHERE id = ?";
        $paramType = "sissi";
        $paramValue = array($name, $roll_number, $dob, $class, $student_id);
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    function deleteStudent($student_id) {
        if($this->role != 'admin') { die("❌ لا تملك صلاحية حذف الطلاب"); }
        $query = "DELETE FROM tbl_student WHERE id = ?";
        $paramType = "i";
        $paramValue = array($student_id);
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    function getStudentById($student_id) {
        $query = "SELECT * FROM tbl_student WHERE id = ?";
        $paramType = "i";
        $paramValue = array($student_id);
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return is_array($result) ? $result : array();
    }

    function getAllStudent() {
        $sql = "SELECT * FROM tbl_student ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return is_array($result) ? $result : array();
    }
}
?>
