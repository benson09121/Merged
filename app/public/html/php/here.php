<?php
include '../../database/database_conn.php';
header('Content-Type: application/json');

$sql = "SELECT * FROM tbl_major_violation";
$result = $conn->query($sql);

if (!$result) {
    die("Error in SQL query: " . $conn->error);
}
if ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode(["message" => "No results found"]);
}