<?php
include '../../database/database_conn.php';

$student_id = $_POST['student_id'];

$sql = "SELECT a.student_id, a.f_name, a.m_name, a.l_name, a.email ,b.name as section, c.name as course
FROM tbl_student_info a
LEFT JOIN tbl_section_info b ON a.section_id = b.section_id
LEFT JOIN tbl_course_info c ON a.course_id = c.course_id
WHERE a.student_id = '$student_id'";

$result = $conn->query($sql);

if($result->num_rows == 0){
    echo "error";
    return;
}

$student = array();

while($row = $result->fetch_assoc()){
    $student[] = $row;
}

echo json_encode($student);
