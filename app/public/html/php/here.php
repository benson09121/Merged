<?php
include '../../database/database_conn.php';

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connection successful";
}

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

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);