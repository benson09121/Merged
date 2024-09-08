<?php
include '../../database/database_conn.php';

$sql = "SELECT * FROM sql12729827.tbl_major_violation";
$result = $conn->query($sql);

$major_violation = array();

while($row = $result->fetch_assoc()){
    $major_violation[] = $row;
}

echo json_encode($major_violation);
$conn->close();
?>