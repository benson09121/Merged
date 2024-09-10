<?php
include '../../database/database_conn.php';

$sql = "SELECT * FROM tbl_penalty_info";
$result = $conn->query($sql);

$category_type = array();

while($row = $result->fetch_assoc()){
    $category_type[] = $row;
}


$sql = "SELECT * FROM tbl_minor_violations";
$result = $conn->query($sql);

$minor_violation = array();

while($row = $result->fetch_assoc()){
    $minor_violation[] = $row;
}

$sql = "SELECT * FROM tbl_major_violation";
$result = $conn->query($sql);

$major_violation = array();

while($row = $result->fetch_assoc()){
    $major_violation[] = $row;
}


$data = [
    'category_type' => $category_type,
    'minor_violation' => $minor_violation,
    'major_violation' => $major_violation
];

echo json_encode($data,  JSON_UNESCAPED_UNICODE);

$conn->close();
?>