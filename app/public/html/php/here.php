<?php
include '../../database/database_conn.php';

$sql = "SELECT * FROM tbl_major_violation";
$result = $conn->query($sql);

$major = array();

while($row = $result->fetch_assoc()){
    $major[] = $row;
}

echo json_encode($major_violation);
?>