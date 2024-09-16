<?php
include '../../database/database_conn.php';

// Ensure proper charset
$conn->set_charset('utf8mb4');

$sql = "SELECT * FROM tbl_admin_info";

$result = $conn->query($sql);

if($result->num_rows > 0){
    $admin_info = array();
    while($row = $result->fetch_assoc()){
        $admin_info[] = $row;
    }   
}
else{
    $admin_info = 'No data';
}
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($admin_info, JSON_UNESCAPED_UNICODE);
$conn->close();