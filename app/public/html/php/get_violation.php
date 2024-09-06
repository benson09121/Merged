<?php
include '../../database/database_conn.php';

$student_id = $_POST['student_id'];


$sql = "SELECT 
    r.slip_no,
    r.student_id,
    r.violation_id,
    t.violation_name,
    r.penalty_id,
    r.comment,
    r.date_of_apprehension,
    r.status AS record_status,
    i.method,
    i.assigned_department,
    i.compliance_due_date,
    i.status AS intervention_status
FROM 
    tbl_major_violation_records r
LEFT JOIN 
    tbl_for_intervention i ON r.slip_no = i.slip_no
LEFT JOIN 
    tbl_major_violation t ON r.violation_id = t.violation_id WHERE r.student_id = '$student_id';";

$result = $conn->query($sql);

if($result->num_rows > 0){
    $major = array();
    while($row = $result->fetch_assoc()){
        $major[] = $row;
    }
}
else{
    $major = 'no data'; 
}


$sql = " SELECT 
    r.slip_no,
    r.student_id,
    r.violation_id,
    v.violation_name,
    r.comment,
    r.date_of_apprehension,
    r.status
FROM 
    tbl_minor_violation_records r
LEFT JOIN 
    tbl_minor_violations v ON r.violation_id = v.violation_id WHERE r.student_id = '$student_id'";

$result = $conn->query($sql);

if($result->num_rows > 0){
    $minor = array();
    while($row = $result->fetch_assoc()){
        $minor[] = $row;
    }
}
else{
    $minor = 'no data';
}

$data = [
    'major' => $major,
    'minor' => $minor
];

echo json_encode($data);