<?php
include '../../database/database_conn.php';

// Ensure proper charset
$conn->set_charset('utf8mb4');

// Fetch category type data from tbl_penalty_info
$sql = "SELECT * FROM tbl_penalty_info";
$result = $conn->query($sql);
$category_type = array();
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $category_type[] = $row;
    }
} else {
    echo 'SQL Error for tbl_penalty_info: ' . $conn->error;
}

// Fetch minor violation data from tbl_minor_violations
$sql = "SELECT * FROM tbl_minor_violations";
$result = $conn->query($sql);
$minor_violation = array();
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $minor_violation[] = $row;
    }
} else {
    echo 'SQL Error for tbl_minor_violations: ' . $conn->error;
}

// Fetch major violation data from tbl_major_violation
$sql = "SELECT * FROM tbl_major_violation";
$result = $conn->query($sql);
$major_violation = array();
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $major_violation[] = $row;
    }
} else {
    echo 'SQL Error for tbl_major_violation: ' . $conn->error;
}

// Combine all data into a single array
$data = [
    'category_type' => $category_type,
    'minor_violation' => $minor_violation,
    'major_violation' => $major_violation
];

// Set headers for JSON output
header('Content-Type: application/json; charset=UTF-8');

// Encode and output the data as JSON
echo json_encode($data, JSON_UNESCAPED_UNICODE);

// Close the database connection
$conn->close();
?>