<?php
include '../../database/database_conn.php';

$sql = "SELECT * FROM tbl_major_violation_records";
$result = $conn->query($sql);

$major_violation = array();

while($row = $result->fetch_assoc()){
    $major_violation[] = $row;
}

echo json_encode($major_violation);
$conn->close();