<?php
include '../../database/database_conn.php';

// Ensure proper charset
$conn->set_charset('utf8mb4');

$student_id = $_POST['student_id'];

// Check if student_id is set and not empty
if (!isset($student_id) || empty($student_id)) {
    echo json_encode(['error' => 'Student ID is required']);
    exit;
}

// Prepare and execute the first query
$sql_major = "SELECT 
    r.slip_no,
    r.student_id,
    r.violation_id,
    t.violation_name,
    r.penalty_id,
    r.comment,
    r.date_of_apprehension,
    r.status AS record_status,
    i.method,
    i.assigned_department,
    i.compliance_due_date,
    i.status AS intervention_status
FROM 
    tbl_major_violation_records r
LEFT JOIN 
    tbl_for_intervention i ON r.slip_no = i.slip_no
LEFT JOIN 
    tbl_major_violation t ON r.violation_id = t.violation_id 
WHERE 
    r.student_id = ?";

$stmt_major = $conn->prepare($sql_major);
if (!$stmt_major) {
    echo json_encode(['error' => 'SQL Error for tbl_major_violation_records: ' . $conn->error]);
    exit;
}
$stmt_major->bind_param('s', $student_id);
$stmt_major->execute();
$result_major = $stmt_major->get_result();

$major = [];
if ($result_major) {
    while ($row = $result_major->fetch_assoc()) {
        $major[] = $row;
    }
} else {
    echo json_encode(['error' => 'SQL Error for tbl_major_violation_records: ' . $stmt_major->error]);
    exit;
}

// Prepare and execute the second query
$sql_minor = "SELECT 
    r.slip_no,
    r.student_id,
    r.violation_id,
    v.violation_name,
    r.comment,
    r.date_of_apprehension,
    r.status
FROM 
    tbl_minor_violation_records r
LEFT JOIN 
    tbl_minor_violations v ON r.violation_id = v.violation_id 
WHERE 
    r.student_id = ?";

$stmt_minor = $conn->prepare($sql_minor);
if (!$stmt_minor) {
    echo json_encode(['error' => 'SQL Error for tbl_minor_violation_records: ' . $conn->error]);
    exit;
}
$stmt_minor->bind_param('s', $student_id);
$stmt_minor->execute();
$result_minor = $stmt_minor->get_result();

$minor = [];
if ($result_minor) {
    while ($row = $result_minor->fetch_assoc()) {
        $minor[] = $row;
    }
} else {
    echo json_encode(['error' => 'SQL Error for tbl_minor_violation_records: ' . $stmt_minor->error]);
    exit;
}

$data = [
    'major' => $major,
    'minor' => $minor
];

// Set headers for JSON output
header('Content-Type: application/json; charset=UTF-8');

// Encode and output the data as JSON
echo json_encode($data, JSON_UNESCAPED_UNICODE);

// Close the statements and connection
$stmt_major->close();
$stmt_minor->close();
$conn->close();
?>