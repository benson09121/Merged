<?php
include '../../database/database_conn.php';

$student_id = $_POST['student_id'];
$first_name = $_POST['f_name'];
$last_name = $_POST['l_name'];
$email = $_POST['email'];

$sql = "UPDATE tbl_student_info SET f_name = '$first_name', l_name = '$last_name', email = '$email' WHERE student_id = '$student_id'";
if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Error updating record: " . $conn->error;
}
