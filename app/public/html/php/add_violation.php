<?php
session_start();
include '../../database/database_conn.php';

$students = $_POST['students'] ?? NULL;
$violation_list = $_POST['violation_list'] ?? NULL;
$penalty_id = $_POST['category'] ?? NULL;
$due_date = $_POST['due_date'] ?? NULL;
$method = $_POST['choice'] ?? NULL;
$department = $_POST['department'] ?? NULL;
$attendees = $_POST['attendees'] ?? NULL;
$conference = $_POST['conference'] ?? NULL;
$date_of_conference = $_POST['date_of_conference'] ?? NULL;
$student_list = [];
$conference_list = [];

// Initialize the session array to store violation details
$_SESSION['violations'] = [];

if ($method == 'counseling') {
    foreach ($students as $student) {
        $student_id = $student['student_id'];
        foreach ($violation_list as $violation) {
            $violation_id = $violation['violation_id'];
            $stmt = $conn->prepare("INSERT INTO tbl_major_violation_records (student_id, violation_id, penalty_id, comment, date_of_apprehension, status) VALUES (?, ?, ?, NULL, NOW(), 'Not Cleared')");
            $stmt->bind_param('sii', $student_id, $violation_id, $penalty_id);
            $stmt->execute();
            $last_id = $conn->insert_id;
            $student_list[] = $last_id;

            // Store violation details in the session array
            $_SESSION['violations'][] = [
                'violation_slip' => $last_id,
                'student_id' => $student_id,
                'name' => $student['student_name'],
                'course' => $student['course'],
                'section' => $student['section']
            ];
        }
    }

    $_SESSION['violation_slip'] = $last_id;

    foreach ($student_list as $student) {
        $stmt = $conn->prepare("INSERT INTO tbl_for_intervention (slip_no, method, assigned_department, compliance_due_date, status) VALUES (?, ?, ?, ?, 'Not Cleared')");
        $stmt->bind_param('isss', $student, $method, $department, $due_date);
        $stmt->execute();
    }

    echo 'success';

} else if ($method == 'community') {
    foreach ($students as $student) {
        $student_id = $student['student_id'];
        foreach ($violation_list as $violation) {
            $violation_id = $violation['violation_id'];
            $stmt = $conn->prepare("INSERT INTO tbl_major_violation_records (student_id, violation_id, penalty_id, comment, date_of_apprehension, status) VALUES (?, ?, ?, NULL, NOW(), 'Not Cleared')");
            $stmt->bind_param('sii', $student_id, $violation_id, $penalty_id);
            $stmt->execute();
            $last_id = $conn->insert_id;
            $student_list[] = $last_id;

            // Store violation details in the session array
            $_SESSION['violations'][] = [
                'violation_slip' => $last_id,
                'student_id' => $student_id,
                'name' => $student['student_name'],
                'course' => $student['course'],
                'section' => $student['section']
            ];
        }
    }

    $_SESSION['violation_slip'] = $last_id;

    foreach ($student_list as $student) {
        $stmt = $conn->prepare("INSERT INTO tbl_for_intervention (slip_no, method, assigned_department, compliance_due_date, status) VALUES (?, ?, ?, ?, 'Not Cleared')");
        $stmt->bind_param('isss', $student, $method, $department, $due_date);
        $stmt->execute();
    }

    echo 'success';

} else if ($method == 'conference') {
    foreach ($students as $student) {
        $student_id = $student['student_id'];
        foreach ($violation_list as $violation) {
            $violation_id = $violation['violation_id'];
            $stmt = $conn->prepare("INSERT INTO tbl_major_violation_records (student_id, violation_id, penalty_id, comment, date_of_apprehension, status) VALUES (?, ?, ?, NULL, NOW(), 'Not Cleared')");
            $stmt->bind_param('sii', $student_id, $violation_id, $penalty_id);
            $stmt->execute();
            $last_id = $conn->insert_id;
            $student_list[] = $last_id;

            // Store violation details in the session array
            $_SESSION['violations'][] = [
                'violation_slip' => $last_id,
                'student_id' => $student_id,
                'name' => $student['student_name'],
                'course' => $student['course'],
                'section' => $student['section']
            ];
        }
    }

    $_SESSION['violation_slip'] = $last_id;

    foreach ($student_list as $student) {
        $stmt = $conn->prepare("INSERT INTO tbl_for_conference (slip_no, scheduled_date, conference_type, status) VALUES (?, ?, ?, 'Not Cleared')");
        $stmt->bind_param('iss', $student, $date_of_conference, $conference);
        $stmt->execute();
        $last_id = $conn->insert_id;
        $conference_list[] = $last_id;
    }

    foreach ($conference_list as $conference) {
        $sql = "INSERT INTO tbl_conf_attendees (conference_no, name) VALUES ";
        $values = [];
        foreach ($attendees as $attendee) {
            $values[] = "($conference, '" . $conn->real_escape_string(trim($attendee)) . "')";
        }
        $sql .= implode(", ", $values);
        $result = $conn->query($sql);
    }

    echo 'success';
}
?>