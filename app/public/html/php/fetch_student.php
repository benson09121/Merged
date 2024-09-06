<?php
include '../../database/database_conn.php';


$search = isset($_POST['search']) ? $_POST['search'] : '';

$sql = "SELECT
a.student_id, 
    a.f_name, 
    a.l_name, 
    e.name as section, 
    b.name as course,
    b.description as course_complete, 
    d.description as school_full,
    a.gender
FROM 
    tbl_student_info a
LEFT JOIN 
    tbl_course_info b ON a.course_id = b.course_id
LEFT JOIN 
    tbl_department_info c ON b.department_id = c.department_id
LEFT JOIN 
    tbl_school_info d ON c.school_id = d.school_id
LEFT JOIN
	tbl_section_info e ON a.section_id = e.section_id
WHERE
  a.student_id LIKE '%$search%'OR 
  a.f_name LIKE '%$search%' OR 
  a.l_name LIKE '%$search%' OR 
  e.name LIKE '%$search%' OR 
  b.description LIKE '%$search%' OR 
  d.description LIKE '%$search%' ";

$result = $conn->query($sql);

$students = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

echo json_encode($students);