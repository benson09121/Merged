<?php
include '../../database/database_conn.php';

$sql = "SELECT * FROM tbl_minor_violations";
$result = $conn->query($sql);

$minor_violation = array();

while($row = $result->fetch_assoc()){
    $minor_violation[] = $row;
}

echo json_encode($minor_violation);