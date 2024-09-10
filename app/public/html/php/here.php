<?php
include '../../database/database_conn.php';

// Ensure proper charset
$conn->set_charset('utf8mb4');

// Query the data
$sql = "SELECT * FROM tbl_major_violation";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        // Set headers for JSON output
        header('Content-Type: application/json; charset=UTF-8');

        // Convert to JSON and handle any errors
        $json_data = json_encode($data, JSON_UNESCAPED_UNICODE);
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo 'JSON Encode Error: ' . json_last_error_msg();
        } else {
            echo $json_data;
        }
    } else {
        echo json_encode(["message" => "No results found"]);
    }
} else {
    echo 'SQL Error: ' . $conn->error;
}
?>