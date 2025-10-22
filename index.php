<?php
session_start();
require_once ("class/DBController.php");
require_once ("class/Student.php");
require_once ("class/Attendance.php"); 

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$role = $_SESSION['role'];

$db_handle = new DBController();
$action = isset($_GET["action"]) ? $_GET["action"] : "";

switch ($action) {


    case "attendance-add":

        if ($role != 'admin') {
            header("Location: index.php?action=attendance");
            exit;
        }

        if (isset($_POST['add'])) {

            $attendance = new Attendance($role); 
            $attendance_timestamp = strtotime($_POST["attendance_date"]);
            $attendance_date = date("Y-m-d", $attendance_timestamp);

            if(!empty($_POST["student_id"])) {
                $attendance->deleteAttendanceByDate($attendance_date);
                foreach($_POST["student_id"] as $k=> $student_id) {
                    $present = 0;
                    $absent = 0;

                    if($_POST["attendance-$student_id"] == "present") $present = 1;
                    if($_POST["attendance-$student_id"] == "absent") $absent = 1;

                    $attendance->addAttendance($attendance_date, $student_id, $present, $absent);
                }
            }
            header("Location: index.php?action=attendance");
        }


        $student = new Student($role);
        $studentResult = $student->getAllStudent();
        require_once "web/attendance-add.php";
        break;

    case "attendance-edit":
        if ($role != 'admin') {
            header("Location: index.php?action=attendance");
            exit;
        }

        $attendance_date = $_GET["date"];

        $attendance = new Attendance($role); 
        if (isset($_POST['add'])) {
            $attendance->deleteAttendanceByDate($attendance_date);
            if(!empty($_POST["student_id"])) {
                foreach($_POST["student_id"] as $k=> $student_id) {
                    $present = 0;
                    $absent = 0;

                    if($_POST["attendance-$student_id"] == "present") $present = 1;
                    if($_POST["attendance-$student_id"] == "absent") $absent = 1;

                    $attendance->addAttendance($attendance_date, $student_id, $present, $absent);
                }
            }
            header("Location: index.php?action=attendance");
        }

        $result = $attendance->getAttendanceByDate($attendance_date);

        $student = new Student($role);
        $studentResult = $student->getAllStudent();
        require_once "web/attendance-edit.php";
        break;

    case "attendance-delete":
        if ($role != 'admin') {
            header("Location: index.php?action=attendance");
            exit;
        }

        $attendance_date = $_GET["date"];
        $attendance = new Attendance($role); 
        $attendance->deleteAttendanceByDate($attendance_date);

        $result = $attendance->getAttendance();
        require_once "web/attendance.php";
        break;

    case "attendance":

        $attendance = new Attendance($role); 
        $result = $attendance->getAttendance();
        require_once "web/attendance.php";
        break;


    case "student-add":
        if ($role != 'admin') {
            header("Location: index.php?action=attendance");
            exit;
        }

        if (isset($_POST['add'])) {
            $name = $_POST['name'];
            $roll_number = $_POST['roll_number'];
            $dob = "";
            if ($_POST["dob"]) $dob = date("Y-m-d", strtotime($_POST["dob"]));
            $class = $_POST['class'];

            $student = new Student($role);
            $insertId = $student->addStudent($name, $roll_number, $dob, $class);

            if (!empty($insertId)) {
                header("Location: index.php");
            } else {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            }
        }
        require_once "web/student-add.php";
        break;

    case "student-edit":
        if ($role != 'admin') {
            header("Location: index.php?action=attendance");
            exit;
        }

        $student_id = $_GET["id"];
        $student = new Student($role); 

        if (isset($_POST['add'])) {
            $name = $_POST['name'];
            $roll_number = $_POST['roll_number'];
            $dob = "";
            if ($_POST["dob"]) $dob = date("Y-m-d", strtotime($_POST["dob"]));
            $class = $_POST['class'];

            $student->editStudent($name, $roll_number, $dob, $class, $student_id);
            header("Location: index.php");
        }

        $result = $student->getStudentById($student_id);
        require_once "web/student-edit.php";
        break;

    case "student-delete":
        if ($role != 'admin') {
            header("Location: index.php?action=attendance");
            exit;
        }

        $student_id = $_GET["id"];
        $student = new Student($role); 
        $student->deleteStudent($student_id);

        $result = $student->getAllStudent();
        require_once "web/student.php";
        break;

    default:

        $student = new Student($role); 
        $result = $student->getAllStudent();
        require_once "web/student.php";
        break;
}

?>