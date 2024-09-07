<?php
include "../../database/database_conn.php";

$student_id = $_POST['student_id'];

$sql = "SELECT 
    a.date_of_apprehension, 
    a.status, 
    'minor' AS type, 
    b.violation_name AS violation_or_penalty, 
    NULL AS comment
FROM tbl_minor_violation_records a
LEFT JOIN tbl_minor_violations b ON a.violation_id = b.violation_id

UNION

SELECT 
    d.date_of_apprehension, 
    d.status, 
    'major' AS type, 
	e.violation_name AS violation, 
    d.comment
FROM tbl_major_violation_records d
LEFT JOIN tbl_major_violation e ON d.violation_id = e.violation_id;";

$result = $conn->query($sql);

$violations = array();

while($row = $result->fetch_assoc()){
    $violations[] = $row;
}

echo json_encode($violations);
mysqli_close($conn);
