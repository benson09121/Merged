<?php
include ('../../database/database_conn.php');


$type = $_POST['type'];
$search = $_POST['search'];
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$limit = isset($_POST['limit']) ? (int)$_POST['limit'] : 5;
$offset = ($page - 1) * $limit;

if($type == 'minor'){
    $sql = "SELECT violation_id, violation_name, 'minor' as type from tbl_minor_violations where violation_name like '%$search%' LIMIT $limit OFFSET $offset";
    $count_sql = "SELECT COUNT(*) as total 
    FROM tbl_minor_violations 
    WHERE violation_name LIKE '%$search%'";
    $result = $conn->query($sql);
    $count_result = $conn->query($count_sql);
    $violation_data = [];
    while($row = mysqli_fetch_assoc($result)){
        $violation_data[] = $row;
    }
}else if($type == 'major'){
    $sql = "SELECT violation_id, violation_type_id, violation_name, 'major' as type from tbl_major_violation where violation_name like '%$search%' LIMIT $limit OFFSET $offset";
    $count_sql = "SELECT COUNT(*) as total 
    FROM tbl_major_violation 
    WHERE violation_name LIKE '%$search%'";
    $result = $conn->query($sql);
    $count_result = $conn->query($count_sql);
    $violation_data = [];
    while($row = mysqli_fetch_assoc($result)){
        $violation_data[] = $row;
    }
}

$count_result = $conn->query($count_sql);
$total = $count_result->fetch_assoc()['total'];
if($total == null){
    $total = 0;
}
$total_pages = ceil($total / $limit);

$sql = "SELECT COUNT(*) from tbl_minor_violations";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);
    $minor = $row['COUNT(*)'];

$sql = "SELECT COUNT(*) from tbl_major_violation";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);
    $major = $row['COUNT(*)'];



$data = [
    'violation_data' => $violation_data,
    'minor' => $minor,
    'major' => $major,
    'totalPages' => $total_pages
];
echo json_encode($data);
$conn->close();