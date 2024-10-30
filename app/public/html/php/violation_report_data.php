<?php
include '../../database/database_conn.php';

$selected = $_POST['selected'];
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$limit = isset($_POST['limit']) ? (int)$_POST['limit'] : 10;
$search = isset($_POST['search']) ? $_POST['search'] : '';
$section = isset($_POST['section']) ? $_POST['section'] : '';
$course = isset($_POST['course']) ? $_POST['course'] : '';
$department = isset($_POST['department']) ? $_POST['department'] : '';
$offset = ($page - 1) * $limit;

$conn->set_charset('utf8mb4');

// Build the additional filters
$additionalFilters = '';
if (!empty($section)) {
    $additionalFilters .= " AND s.name LIKE '%$section%'";
}
if (!empty($course)) {
    $additionalFilters .= " AND d.name LIKE '%$course%'";
}
if (!empty($department)) {
    $additionalFilters .= " AND h.school_name LIKE '%$department%'";
}

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
        s.name as section_name,
        h.school_name as school_name,
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
    JOIN 
        tbl_section_info s ON c.section_id = s.section_id
    JOIN
        tbl_department_info g ON d.department_id = g.department_id
    JOIN
        tbl_school_info h ON g.school_id = h.school_id 
    WHERE 
        (v.violation_name LIKE '%$search%' OR
        c.f_name LIKE '%$search%' OR
        c.l_name LIKE '%$search%' OR
        r.student_id LIKE '%$search%' OR
        d.name LIKE '%$search%' OR
        r.date_of_apprehension LIKE '%$search%' OR
        r.status LIKE '%$search%')
        $additionalFilters
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
        s.name as section_name,
        h.school_name as school_name,
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
    JOIN 
        tbl_section_info s ON c.section_id = s.section_id
    JOIN
        tbl_department_info g ON d.department_id = g.department_id
    JOIN
        tbl_school_info h ON g.school_id = h.school_id 
    WHERE 
        (v.violation_name LIKE '%$search%' OR
        c.f_name LIKE '%$search%' OR
        c.l_name LIKE '%$search%' OR
        r.student_id LIKE '%$search%' OR
        d.name LIKE '%$search%' OR
        r.date_of_apprehension LIKE '%$search%' OR
        r.status LIKE '%$search%')
        $additionalFilters
    ORDER BY 
        date_of_apprehension DESC
    LIMIT $limit OFFSET $offset";
    
    $countSql = "SELECT COUNT(*) as total FROM (
        SELECT r.slip_no
        FROM tbl_minor_violation_records r
        JOIN tbl_minor_violations v ON r.violation_id = v.violation_id
        JOIN tbl_student_info c ON r.student_id = c.student_id
        JOIN tbl_course_info d ON c.course_id = d.course_id
        JOIN tbl_section_info s ON c.section_id = s.section_id
        JOIN tbl_department_info g ON d.department_id = g.department_id
        JOIN tbl_school_info h ON g.school_id = h.school_id 
        WHERE (v.violation_name LIKE '%$search%' OR
        c.f_name LIKE '%$search%' OR
        c.l_name LIKE '%$search%' OR
        r.student_id LIKE '%$search%' OR
        d.name LIKE '%$search%' OR
        r.date_of_apprehension LIKE '%$search%' OR
        r.status LIKE '%$search%')
        $additionalFilters
        UNION ALL
        SELECT r.slip_no
        FROM tbl_major_violation_records r
        JOIN tbl_major_violation v ON r.violation_id = v.violation_id
        JOIN tbl_student_info c ON r.student_id = c.student_id
        JOIN tbl_course_info d ON c.course_id = d.course_id
        JOIN tbl_section_info s ON c.section_id = s.section_id
        JOIN tbl_department_info g ON d.department_id = g.department_id
        JOIN tbl_school_info h ON g.school_id = h.school_id 
        WHERE (v.violation_name LIKE '%$search%' OR
        c.f_name LIKE '%$search%' OR
        c.l_name LIKE '%$search%' OR
        r.student_id LIKE '%$search%' OR
        d.name LIKE '%$search%' OR
        r.date_of_apprehension LIKE '%$search%' OR
        r.status LIKE '%$search%')
        $additionalFilters
    ) as combined";
} else if ($selected == 'minor') {
    $sql = "SELECT
        'minor' AS violation_type,
        r.slip_no,
        c.f_name as name,
        c.l_name as lastname,
        r.student_id,
        d.name as course_name,
        v.violation_name,
        r.comment,
        s.name as section_name,
        h.school_name as school_name,
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
    JOIN 
        tbl_section_info s ON c.section_id = s.section_id
    JOIN
        tbl_department_info g ON d.department_id = g.department_id
    JOIN
        tbl_school_info h ON g.school_id = h.school_id 
    WHERE
        (v.violation_name LIKE '%$search%' OR
        c.f_name LIKE '%$search%' OR
        c.l_name LIKE '%$search%' OR
        r.student_id LIKE '%$search%' OR
        d.name LIKE '%$search%' OR
        r.date_of_apprehension LIKE '%$search%' OR
        r.status LIKE '%$search%')
        $additionalFilters
    ORDER BY 
        date_of_apprehension DESC
    LIMIT $limit OFFSET $offset";
    
    $countSql = "SELECT COUNT(*) as total FROM tbl_minor_violation_records r
    JOIN tbl_minor_violations v ON r.violation_id = v.violation_id
    JOIN tbl_student_info c ON r.student_id = c.student_id
    JOIN tbl_course_info d ON c.course_id = d.course_id
    JOIN tbl_section_info s ON c.section_id = s.section_id
    JOIN tbl_department_info g ON d.department_id = g.department_id
    JOIN tbl_school_info h ON g.school_id = h.school_id 
    WHERE (v.violation_name LIKE '%$search%' OR
    c.f_name LIKE '%$search%' OR
    c.l_name LIKE '%$search%' OR
    r.student_id LIKE '%$search%' OR
    d.name LIKE '%$search%' OR
    r.date_of_apprehension LIKE '%$search%' OR
    r.status LIKE '%$search%')
    $additionalFilters";
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
        s.name as section_name,
        h.school_name as school_name,
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
    JOIN 
        tbl_section_info s ON c.section_id = s.section_id
    JOIN
        tbl_department_info g ON d.department_id = g.department_id
    JOIN
        tbl_school_info h ON g.school_id = h.school_id 
    WHERE 
        (v.violation_name LIKE '%$search%' OR
        c.f_name LIKE '%$search%' OR
        c.l_name LIKE '%$search%' OR
        r.student_id LIKE '%$search%' OR
        d.name LIKE '%$search%' OR
        r.date_of_apprehension LIKE '%$search%' OR
        r.status LIKE '%$search%')
        $additionalFilters
    ORDER BY 
        date_of_apprehension DESC
    LIMIT $limit OFFSET $offset";
    
    $countSql = "SELECT COUNT(*) as total FROM tbl_major_violation_records r
    JOIN tbl_major_violation v ON r.violation_id = v.violation_id
    JOIN tbl_student_info c ON r.student_id = c.student_id
    JOIN tbl_course_info d ON c.course_id = d.course_id
    JOIN tbl_section_info s ON c.section_id = s.section_id
    JOIN tbl_department_info g ON d.department_id = g.department_id
    JOIN tbl_school_info h ON g.school_id = h.school_id 
    WHERE (v.violation_name LIKE '%$search%' OR
    c.f_name LIKE '%$search%' OR
    c.l_name LIKE '%$search%' OR
    r.student_id LIKE '%$search%' OR
    d.name LIKE '%$search%' OR
    r.date_of_apprehension LIKE '%$search%' OR
    r.status LIKE '%$search%')
    $additionalFilters";
}

$result = $conn->query($sql);

if ($result) {
    $all = array();
    while ($row = $result->fetch_assoc()) {
        $all[] = $row;
    }
} else {
    $all[] = ['message' => 'No data found'];
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