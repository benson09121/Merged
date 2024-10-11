<?php
header('Content-type: application/json; charset=utf-8');
include '../database/database_conn.php';

$studID = $_POST['studID'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$section = $_POST['section'];
$course = $_POST['course'];
$password = $_POST['password'];
$gender = $_POST['gender'];

$sql = "SELECT * 
        FROM sql12729827.tbl_student_info
        WHERE student_id = '$studID'
        ;";


$result = mysqli_query($conn, $sql);

$final_data = [];

if (mysqli_num_rows($result) >= 1) {

    $row = mysqli_fetch_assoc($result);

    if (!$row['password']) {
        # code...

        $hashedPass = password_hash($password, PASSWORD_DEFAULT);

        $sql2 = "UPDATE `sql12729827`.`tbl_student_info` 
                SET 
                `f_name` = '$fname', 
                `m_name` = '$mname', 
                `l_name` = '$lname', 
                `course_id` = '$course', 
                `section_id` = '$section', 
                `email` = '$email', 
                `gender` = '$gender', 
                `password` = '$hashedPass'
                WHERE (`student_id` = '$studID');";


        if (mysqli_query($conn, $sql2)) {
            header("HTTP/1.0 200 magnificent");
            echo json_encode(['status' => 'Good', 'message' => 'Registered successfully']);
        } else {
            header("HTTP/1.0 200 ok");
            echo json_encode(['status' => 'Fail', 'message' => 'Registration failed']);
        }


    } else {
        # code...
        header("HTTP/1.0 200 ok");
        echo json_encode(['status' => 'Fail', 'message' => 'Account has already been registered']);

    }


} else {
    header("HTTP/1.0 200 ok");
    echo json_encode(['status' => 'Fail', 'message' => 'The following Student ID is not valid']);
}




mysqli_close($conn);
