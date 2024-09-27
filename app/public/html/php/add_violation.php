<?php
session_start();
include '../../database/database_conn.php';

$student_id = $_POST['student_id'] ?? NULL;
$violation_id = $_POST['violation_type']?? NULL;
$penalty_id = $_POST['category'] ?? NULL;
$due_date = $_POST['due_date'] ?? NULL;
$method = $_POST['choice'] ?? NULL;
$department = $_POST['department'] ?? NULL;
$attendees = $_POST['attendees'] ?? NULL;
$conference = $_POST['conference'] ?? NULL;
$date_of_conference = $_POST['date_of_conference'] ?? NULL;


if ($method == 'counseling') {

    $sql = "INSERT INTO tbl_major_violation_records(student_id,violation_id,penalty_id,comment,date_of_apprehension,status)
VALUES('$student_id',$violation_id,$penalty_id,NULL,NOW(),'Not Cleared')";
    $result = $conn->query($sql);
    $last_id = $conn->insert_id;
    $_SESSION['violation_slip'] = $last_id;
    $sql = "INSERT INTO tbl_for_intervention (slip_no,method,assigned_department,compliance_due_date,status)
VALUES ($last_id, '$method',  NULL, '$due_date', 'Not Cleared')";
    $result = $conn->query($sql);

    $sql = "SELECT * FROM tbl_major_violation WHERE violation_id = $violation_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $_SESSION['violation'] = $violation = $row['short_desc'];

    echo 'success';
} else if ($method == 'community') {
    $sql = "INSERT INTO tbl_major_violation_records(student_id,violation_id,penalty_id,comment,date_of_apprehension,status)
    VALUES('$student_id',$violation_id,$penalty_id,NULL,NOW(),'Not Cleared')";
    $result = $conn->query($sql);
    $last_id = $conn->insert_id;
    $_SESSION['violation_slip'] = $last_id;
    $sql = "INSERT INTO tbl_for_intervention (slip_no,method,assigned_department,compliance_due_date,status)
    VALUES ($last_id, '$method','$department', '$due_date', 'Not Cleared')";
    $result = $conn->query($sql);
    $sql = "SELECT * FROM tbl_major_violation WHERE violation_id = $violation_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $_SESSION['violation'] = $violation = $row['short_desc'];

    echo 'success';
} else if($method == "conference"){
    $sql = "INSERT INTO tbl_major_violation_records(student_id,violation_id,penalty_id,comment,date_of_apprehension,status)
    VALUES('$student_id',$violation_id,$penalty_id,NULL,NOW(),'Not Cleared')";
    $result = $conn->query($sql);
    $last_id = $conn->insert_id;
    $_SESSION['violation_slip'] = $last_id;
    $sql = "INSERT INTO tbl_for_conference(slip_no,scheduled_date,conference_type,status) VALUES
    ($last_id,'$date_of_conference','$conference','Not Cleared')";
    $result = $conn->query($sql);
    $last_id = $conn->insert_id;
    if (is_array($attendees) && count($attendees) > 0) {
        // Prepare the base SQL statement
        $sql = "INSERT INTO tbl_conf_attendees(conference_no, name) VALUES ";

        // Build the values part of the SQL statement
        $values = [];
        foreach ($attendees as $attendee) {
            $values[] = "($last_id, '" . $conn->real_escape_string(trim($attendee)) . "')";
        }

        // Concatenate the values into a single string
        $sql .= implode(", ", $values);

        // Execute the SQL statement
        $result = $conn->query($sql);
    }
    $sql = "SELECT * FROM tbl_major_violation WHERE violation_id = $violation_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $_SESSION['violation'] = $violation = $row['short_desc'];

    echo 'success';
}