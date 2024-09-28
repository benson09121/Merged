<?php
include '../../database/database_conn.php';

$selected = $_POST['selected'];
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$limit = isset($_POST['limit']) ? (int)$_POST['limit'] : 10;
$search = isset($_POST['search']) ? $_POST['search'] : '';
$offset = ($page - 1) * $limit;

$conn->set_charset('utf8mb4');

// Query to get the data based on the selected type
if ($selected == 'all') {
    $sql = "SELECT 
        'minor' AS violation_type, 
        r.slip_no, 
        c.f_name as name,
        c.l_name as lastname,
        r.student_id,
        d.name as course_name,
        v.violation_name, 
        r.comment, 
        r.date_of_apprehension, 
        r.status
    FROM 
        tbl_minor_violation_records r
    JOIN 
        tbl_minor_violations v ON r.violation_id = v.violation_id
    JOIN 
        tbl_student_info c ON r.student_id = c.student_id
    JOIN 
        tbl_course_info d ON c.course_id = d.course_id
    WHERE 
        v.violation_name LIKE '%$search%'
    UNION ALL
    SELECT 
        'major' AS violation_type, 
        r.slip_no, 
        c.f_name as name,
        c.l_name as lastname,
        r.student_id, 
        d.name as course_name,
        v.violation_name, 
        r.comment, 
        r.date_of_apprehension, 
        r.status
    FROM 
        tbl_major_violation_records r
    JOIN 
        tbl_major_violation v ON r.violation_id = v.violation_id
    JOIN 
        tbl_student_info c ON r.student_id = c.student_id
    JOIN 
        tbl_course_info d ON c.course_id = d.course_id
    WHERE 
        v.violation_name LIKE '%$search%'
    ORDER BY 
        date_of_apprehension DESC
    LIMIT $limit OFFSET $offset";
    
    $countSql = "SELECT COUNT(*) as total FROM (
        SELECT r.slip_no
        FROM tbl_minor_violation_records r
        JOIN tbl_minor_violations v ON r.violation_id = v.violation_id
        JOIN tbl_student_info c ON r.student_id = c.student_id
        JOIN tbl_course_info d ON c.course_id = d.course_id
        WHERE v.violation_name LIKE '%$search%'
        UNION ALL
        SELECT r.slip_no
        FROM tbl_major_violation_records r
        JOIN tbl_major_violation v ON r.violation_id = v.violation_id
        JOIN tbl_student_info c ON r.student_id = c.student_id
        JOIN tbl_course_info d ON c.course_id = d.course_id
        WHERE v.violation_name LIKE '%$search%'
    ) as combined";
} else if ($selected == 'minor') {
    $sql = "SELECT
        'minor' AS violation_type,
        r.student_id,
        c.f_name as name,
        c.l_name as lastname,
        d.name as course_name,
        v.violation_name,
        r.date_of_apprehension,
        r.status
    FROM 
        tbl_minor_violation_records r
    JOIN 
        tbl_minor_violations v ON r.violation_id = v.violation_id
    JOIN 
        tbl_student_info c ON r.student_id = c.student_id
    JOIN 
        tbl_course_info d ON c.course_id = d.course_id
    WHERE
        v.violation_name LIKE '%$search%'
    ORDER BY 
        date_of_apprehension DESC
    LIMIT $limit OFFSET $offset";
    
    $countSql = "SELECT COUNT(*) as total FROM tbl_minor_violation_records r
    JOIN tbl_minor_violations v ON r.violation_id = v.violation_id
    JOIN tbl_student_info c ON r.student_id = c.student_id
    JOIN tbl_course_info d ON c.course_id = d.course_id
    WHERE v.violation_name LIKE '%$search%'";
} else if ($selected == 'major') {
    $sql = "SELECT
        'major' AS violation_type,
        r.slip_no, 
        c.f_name as name,
        c.l_name as lastname,
        r.student_id, 
        d.name as course_name,
        v.violation_name, 
        r.comment, 
        r.date_of_apprehension, 
        r.status
    FROM 
        tbl_major_violation_records r
    JOIN 
        tbl_major_violation v ON r.violation_id = v.violation_id
    JOIN 
        tbl_student_info c ON r.student_id = c.student_id
    JOIN 
        tbl_course_info d ON c.course_id = d.course_id
    WHERE 
        v.violation_name LIKE '%$search%'
    ORDER BY 
        date_of_apprehension DESC
    LIMIT $limit OFFSET $offset";
    
    $countSql = "SELECT COUNT(*) as total FROM tbl_major_violation_records r
    JOIN tbl_major_violation v ON r.violation_id = v.violation_id
    JOIN tbl_student_info c ON r.student_id = c.student_id
    JOIN tbl_course_info d ON c.course_id = d.course_id
    WHERE v.violation_name LIKE '%$search%'";
}

$result = $conn->query($sql);

if ($result) {
    $all = array();
    while ($row = $result->fetch_assoc()) {
        $all[] = $row;
    }
} else {
    echo "failed";
}

// Get the total number of records
$countResult = $conn->query($countSql);
$totalRecords = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRecords / $limit);

// Count all minor violations
$minorCountResult = $conn->query("SELECT COUNT(*) as count FROM tbl_minor_violation_records");
$minorCount = $minorCountResult->fetch_assoc()['count'];

// Count all major violations
$majorCountResult = $conn->query("SELECT COUNT(*) as count FROM tbl_major_violation_records");
$majorCount = $majorCountResult->fetch_assoc()['count'];

// Combined count
$combinedCount = $minorCount + $majorCount;

$data = [
    'all' => $all,
    'totalPages' => $totalPages,
    'minorCount' => $minorCount,
    'majorCount' => $majorCount,
    'combinedCount' => $combinedCount
];

// Set headers for JSON output
header('Content-Type: application/json; charset=UTF-8');

// Encode and output the data as JSON
echo json_encode($data, JSON_UNESCAPED_UNICODE);

$conn->close();
?>