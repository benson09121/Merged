<?php
session_start();
include '../../database/database_conn.php';

$student_json = $_POST['students'];
$violation_type = $_POST['violation_type'];

$sql = "SELECT * FROM tbl_minor_violations WHERE violation_id = $violation_type";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$_SESSION['violation'] = $row['short_desc'];

$students = json_decode($student_json, true);
$stmt = $conn->prepare("INSERT INTO tbl_minor_violation_records (student_id, violation_id, date_of_apprehension, status) VALUES (?, ?, NOW(), 'Not Cleared')");

foreach ($students as $student) {
    $student_id = $student['student_id'];
    $stmt->bind_param('si', $student_id, $violation_type);
    $stmt->execute();
}


echo 'success';

// Close the statement and connection
$stmt->close();
