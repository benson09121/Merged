<?php
include '../../database/database_conn.php';
header('Content-Type: application/json');

$conn->set_charset('utf8');
$sql = "SELECT * FROM tbl_major_violation";
$result = $conn->query($sql);

if ($result) {
    echo "Query executed successfully";
    if ($result->num_rows > 0) {
        echo "Number of rows: " . $result->num_rows;
        while ($row = $result->fetch_assoc()) {
            print_r($row);  // Print each row
        }
    } else {
        echo "No rows found in tbl_major_violation";
    }
} else {
    die("SQL Error: " . $conn->error);
}