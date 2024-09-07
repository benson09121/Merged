<?php
include '../../database/database_conn.php';

$sql = "SELECT * FROM tbl_penalty_info";
$result = $conn->query($sql);

$category_type = array();

while($row = $result->fetch_assoc()){
    $category_type[] = $row;
}

echo json_encode($category_type);
?>