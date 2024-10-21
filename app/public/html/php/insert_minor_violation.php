<?php
session_start();
include '../../database/database_conn.php';

$students = $_POST['students'];
$violation_list = $_POST['violation_list'] ?? NULL;


$_SESSION['students_list'] = $students;
$_SESSION['violationString'] = $_POST['violationString'] ?? '';
$_SESSION['offense'] = "Minor";
$stmt = $conn->prepare("INSERT INTO tbl_minor_violation_records (student_id, violation_id, date_of_apprehension, status) VALUES (?, ?, NOW(), 'Not Cleared')");

// Initialize the session array to store violation details
$_SESSION['violations'] = [];

foreach ($students as $student) {
    $student_id = $student['student_id'];
    foreach ($violation_list as $violation) {
        $violation_id = $violation['violation_id'];

        // Fetch violation description
        $sql = "SELECT * FROM tbl_minor_violations WHERE violation_id = ?";
        $violation_stmt = $conn->prepare($sql);
        $violation_stmt->bind_param('i', $violation_id);
        $violation_stmt->execute();
        $result = $violation_stmt->get_result();
        $row = $result->fetch_assoc();
        $violation_desc = $row['short_desc'];

        // Insert violation record
        $stmt->bind_param('si', $student_id, $violation_id);
        $stmt->execute();
        $last_id = $conn->insert_id;

        // Store violation details in the session array
        $_SESSION['violations'][] = [
            'violation_slip' => $last_id,
            'student_id' => $student_id,
            'name' => $student['student_name'],
            'course' => $student['course'],
            'section' => $student['section'],
            'violation_desc' => $violation_desc
        ];
    }
}

echo 'success';

// Close the statement and connection
$stmt->close();
$conn->close();
?>