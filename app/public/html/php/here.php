<?php
include '../../database/database_conn.php';

$sql = "SELECT * FROM tbl_major_violation";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo "0 results";
}