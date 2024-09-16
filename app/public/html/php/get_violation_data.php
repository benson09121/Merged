<?php
include('../../database/database_conn.php');

// Ensure proper charset
$conn->set_charset('utf8mb4');

// Initialize variables
$type = isset($_POST['type']) ? $_POST['type'] : '';
$search = isset($_POST['search']) ? $_POST['search'] : '';
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$limit = isset($_POST['limit']) ? (int)$_POST['limit'] : 5;
$offset = ($page - 1) * $limit;
$violation_data = [];

// Prepared statement to prevent SQL injection
if ($type == 'minor') {
    $stmt = $conn->prepare("SELECT violation_id, violation_name, 'minor' as type 
                            FROM tbl_minor_violations 
                            WHERE violation_name LIKE ? 
                            LIMIT ? OFFSET ?");
    $search_like = '%' . $search . '%';
    $stmt->bind_param("sii", $search_like, $limit, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $violation_data[] = $row;
    }
    
    $count_stmt = $conn->prepare("SELECT COUNT(*) as total 
                                  FROM tbl_minor_violations 
                                  WHERE violation_name LIKE ?");
    $count_stmt->bind_param("s", $search_like);
    $count_stmt->execute();
    $count_result = $count_stmt->get_result();
    $total = $count_result->fetch_assoc()['total'];
    
} elseif ($type == 'major') {
    $stmt = $conn->prepare("SELECT violation_id, violation_type_id, violation_name, 'major' as type 
                            FROM tbl_major_violation 
                            WHERE violation_name LIKE ? 
                            LIMIT ? OFFSET ?");
    $search_like = '%' . $search . '%';
    $stmt->bind_param("sii", $search_like, $limit, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $violation_data[] = $row;
    }
    
    $count_stmt = $conn->prepare("SELECT COUNT(*) as total 
                                  FROM tbl_major_violation 
                                  WHERE violation_name LIKE ?");
    $count_stmt->bind_param("s", $search_like);
    $count_stmt->execute();
    $count_result = $count_stmt->get_result();
    $total = $count_result->fetch_assoc()['total'];
} else {
    // If no valid type is passed, return empty data
    $total = 0;
}

if ($total === null) {
    $total = 0;
}
$total_pages = ceil($total / $limit);

// Get total counts for minor and major violations
$sql = "SELECT COUNT(*) as minor_count FROM tbl_minor_violations";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
$minor = $row['minor_count'];

$sql = "SELECT COUNT(*) as major_count FROM tbl_major_violation";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
$major = $row['major_count'];

// Prepare the final data array
$data = [
    'violation_data' => $violation_data,
    'minor' => $minor,
    'major' => $major,
    'totalPages' => $total_pages
];

// Return data as JSON
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($data, JSON_UNESCAPED_UNICODE);

// Close the connection
$conn->close();
?>
