<?php
include '../../database/database_conn.php';

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
}

$sql = "SELECT * FROM tbl_major_violation";
$result = $conn->query($sql);
$major_violation = [];
if ($result) {

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $major_violation[] = $row;
        }
    } else {
        echo "No rows found in tbl_major_violation";
    }
} else {
    die("SQL Error: " . $conn->error);
}

echo $major_violation;