<?php
session_start();
include '../../database/database_conn.php';

$student_id = $_POST['student_id'];
$violation_type = $_POST['violation_type'];

$sql = "SELECT * FROM tbl_minor_violations WHERE violation_id = $violation_type";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$_SESSION['violation'] = $row['short_desc'];

$sql = "INSERT INTO tbl_minor_violation_records(student_id, violation_id,date_of_apprehension,status) VALUES ('$student_id', '$violation_type',NOW(),'Not Cleared')";
if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
