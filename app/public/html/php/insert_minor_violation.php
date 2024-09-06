<?php
include '../../database/database_conn.php';

$student_id = $_POST['student_id'];

$violation_type = $_POST['violation_type'];

$sql = "INSERT INTO tbl_minor_violation_records(student_id, violation_id,date_of_apprehension,status) VALUES ('$student_id', '$violation_type',NOW(),'Not Cleared')";

if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
