<?php
include '../../database/database_conn.php';

$select = $_POST['select'];

$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$limit = isset($_POST['limit']) ? (int)$_POST['limit'] : 10;
$search = isset($_POST['search']) ? $_POST['search'] : '';
$offset = ($page - 1) * $limit;

if($select == 'for review'){
    $select = 'pending';
}

if($select == 'all'){
    $sql = "SELECT 
    'Entry Pass' AS request_type,
    a.request_no,
    a.student_id,
    a.purpose,
    a.reason,
    a.date_requested,
    a.valid_until,
    a.status,
    NULL AS proof_of_payment,
    NULL AS date_released,
    a.admin_incharge
FROM 
    tbl_request_entrypass a
WHERE 
    a.student_id LIKE '%$search%' OR
     a.reason LIKE '%$search%'

UNION ALL

SELECT 
    'Admission Pass' AS request_type,
    b.request_no,
    b.student_id,
    b.purpose,
    b.reason,
    b.date_requested,
    NULL AS valid_until,
    b.status,
    NULL AS proof_of_payment,
    NULL AS date_released,
    b.admin_incharge
FROM 
    tbl_request_admissionpass b
WHERE 
    b.student_id LIKE '%$search%' OR
     b.reason LIKE '%$search%'

UNION ALL

SELECT 
    'Good Moral' AS request_type,
    c.request_no,
    c.student_id,
    NULL AS purpose,
    c.reason,
    c.date_requested,
    NULL AS valid_until,
    c.status,
    c.proof_of_payment,
    c.date_released,
    c.admin_incharge
FROM 
    tbl_request_goodmoral c
WHERE 
    c.student_id LIKE '%$search%' OR
     c.reason LIKE '%$search%'";
} else{
    $sql = "SELECT 
    'Entry Pass' AS request_type,
    a.request_no,
    a.student_id,
    a.purpose,
    a.reason,
    a.date_requested,
    a.valid_until,
    a.status,
    NULL AS proof_of_payment,
    NULL AS date_released,
    a.admin_incharge
FROM 
    tbl_request_entrypass a 
WHERE 
    (a.student_id LIKE '%$search%' OR
     a.purpose LIKE '%$search%')
    AND a.status = '$select'

UNION ALL

SELECT 
    'Admission Pass' AS request_type,
    b.request_no,
    b.student_id,
    b.purpose,
    b.reason,
    b.date_requested,
    NULL AS valid_until,
    b.status,
    NULL AS proof_of_payment,
    NULL AS date_released,
    b.admin_incharge
FROM 
    tbl_request_admissionpass b
WHERE 
    (b.student_id LIKE '%$search%' OR
     b.purpose LIKE '%$search%')
    AND b.status = '$select'

UNION ALL

SELECT 
    'Good Moral' AS request_type,
    c.request_no,
    c.student_id,
    NULL AS purpose,
    c.reason,
    c.date_requested,
    NULL AS valid_until,
    c.status,
    c.proof_of_payment,
    c.date_released,
    c.admin_incharge
FROM 
    tbl_request_goodmoral c
WHERE 
    (c.student_id LIKE '%$search%' OR
     c.reason LIKE '%$search%')
    AND c.status = '$select'

ORDER BY request_no
LIMIT $limit OFFSET $offset";    
}

$result = $conn->query($sql);

$totalPages = ceil($result->num_rows / $limit);

if($result->num_rows > 0){
    $data = array();
    while($row = $result->fetch_assoc()){
        $data[] = $row;
    }
}
else{
    $data = 'no data'; 
}

$response = [
    'data' => $data,
    'totalPages' => $totalPages
];

echo json_encode($response);