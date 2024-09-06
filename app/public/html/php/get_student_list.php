<?php
include '../../database/database_conn.php';
// Get page number and limit from the POST request
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$limit = isset($_POST['limit']) ? (int)$_POST['limit'] : 10;
$status = $_POST['status'];
$search = isset($_POST['search']) ? $_POST['search'] : '';
$offset = ($page - 1) * $limit;

$section = isset($_POST['section']) ? $_POST['section'] : '';
$course = isset($_POST['course']) ? $_POST['course'] : '';
$department = isset($_POST['department']) ? $_POST['department'] : '';

if($section === ''){
    $section = $search;
}
if($course === ''){
    $course = $search;
}
if($department === ''){
    $department = $search;
}

$query = "SELECT 
    a.student_id, 
    a.f_name, 
    a.m_name, 
    a.l_name, 
    e.name as section, 
    b.name,
    b.description as course_complete, 
    d.description as school_full,
    d.school_name, 
    a.email, 
    a.gender, 
    a.account_status, 
    (SELECT COUNT(DISTINCT a2.student_id) 
     FROM tbl_student_info a2
     LEFT JOIN tbl_course_info b2 ON a2.course_id = b2.course_id
     LEFT JOIN tbl_department_info c2 ON b2.department_id = c2.department_id
     LEFT JOIN tbl_school_info d2 ON c2.school_id = d2.school_id
     LEFT JOIN tbl_section_info e2 ON a2.section_id = e2.section_id
     WHERE(a.student_id LIKE '%$search%'OR 
     a2.f_name LIKE '%$search%' OR 
     a2.l_name LIKE '%$search%' OR 
     e2.name LIKE '%$section%' OR 
     b2.description LIKE '%$course%' OR 
     d2.description LIKE '%$department%') 
     AND a2.account_status = '$status'
    ) AS total
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
  (a.student_id LIKE '%$search%'OR 
  a.f_name LIKE '%$search%' OR 
  a.l_name LIKE '%$search%' OR 
  e.name LIKE '%$search%' OR 
  b.description LIKE '%$search%' OR 
  d.description LIKE '%$search%') 
  AND a.account_status = '$status' 
LIMIT $limit OFFSET $offset;";

$result = $conn->query($query);

$totalResult = $conn->query($query);
$totalRow = $totalResult->fetch_assoc();
if($totalRow === null){
    $totalRecords = 0;
}else{
$totalRecords = $totalRow['total'];
}   
$totalPages = ceil($totalRecords / $limit);


$students = [];
while($row = $result->fetch_assoc()) {
    if($row === FALSE){
        break;
    }
    $students[] = $row;
}


$response = [
    'students' => $students,
    'totalPages' => $totalPages
];

echo json_encode($response);
?>