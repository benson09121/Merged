<?php
include '../../database/database_conn.php';

$student_id = $_POST['student_id'];
$violation_id = $_POST['violation_type'];
$penalty_id = $_POST['category'];
$due_date = $_POST['due_date'];
$method = $_POST['choice'];
$department = $_POST['department'] ?? NULL;

if($method == 'counseling'){

    $sql = "INSERT INTO tbl_major_violation_records(student_id,violation_id,penalty_id,comment,date_of_apprehension,status)
VALUES('$student_id',$violation_id,$penalty_id,NULL,NOW(),'Not Cleared')";
$result = $conn->query($sql);
#get the id of last inserted record
$last_id = $conn->insert_id;
$sql = "INSERT INTO tbl_for_intervention (slip_no,method,assigned_department,compliance_due_date,status)
VALUES ($last_id, '$method',  NULL, '$due_date', 'Not Cleared')";
$result = $conn->query($sql);
echo 'success';
} else if($method == 'community'){
    $sql = "INSERT INTO tbl_major_violation_records(student_id,violation_id,penalty_id,comment,date_of_apprehension,status)
    VALUES('$student_id',$violation_id,$penalty_id,NULL,NOW(),'Not Cleared')";
    $result = $conn->query($sql);
    #get the id of last inserted record
    $last_id = $conn->insert_id;
    $sql = "INSERT INTO tbl_for_intervention (slip_no,method,assigned_department,compliance_due_date,status)
    VALUES ($last_id, '$method','$department', '$due_date', 'Not Cleared')";
    $result = $conn->query($sql);
    echo 'success';
}

mysqli_close($conn);
