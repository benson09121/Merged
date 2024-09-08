<?php
include '../../database/database_conn.php';

$selected = $_POST['selected'];
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$limit = isset($_POST['limit']) ? (int)$_POST['limit'] : 10;
$search = isset($_POST['search']) ? $_POST['search'] : '';
$offset = ($page - 1) * $limit;

if($selected == 'all'){
    $sql = "SELECT 
    'minor' AS violation_type, 
    r.slip_no, 
    r.student_id, 
    v.violation_name, 
    r.comment, 
    r.date_of_apprehension, 
    r.status
FROM 
    tbl_minor_violation_records r
JOIN 
    tbl_minor_violations v ON r.violation_id = v.violation_id
WHERE 
    v.violation_name LIKE '%%'
UNION ALL
SELECT 
    'major' AS violation_type, 
    r.slip_no, 
    r.student_id, 
    v.violation_name, 
    r.comment, 
    r.date_of_apprehension, 
    r.status
FROM 
    tbl_major_violation_records r
JOIN 
    tbl_major_violation v ON r.violation_id = v.violation_id
WHERE 
    v.violation_name LIKE '%%'
ORDER BY 
    date_of_apprehension DESC
LIMIT $limit OFFSET $offset;";
}
else if($selected == 'minor'){
    $sql = "SELECT * FROM tbl_minor_violation_records";
}
else if($selected == 'major'){
    $sql = "SELECT * FROM tbl_major_violation_records";
}

$result = $conn->query($sql);

$totalRow = $result->fetch_assoc();
if($totalRow === null){
    $totalRecords = 0;
}else{
$totalRecords = mysqli_num_rows($result);
}   
$totalPages = ceil($totalRecords / $limit);

if($result){
    $all = array();
    while($row = $result->fetch_assoc()){
        $all[] = $row;
    }
}
else{
    echo "failed";
}

$data = [
    'all' => $all,
    'totalPages' => $totalPages

];

echo json_encode($data);
$conn->close();