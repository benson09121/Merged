<?php
// Database connection
include '../../database/database_conn.php';

// Search term (if applicable)

// SQL query for minor violations
$sql_minor = "
    SELECT 
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
";

// SQL query for major violations
$sql_major = "
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
";

// Execute both queries
$result_minor = $conn->query($sql_minor);
$result_major = $conn->query($sql_major);

// Fetch the results into arrays
$minor_violations = [];
$major_violations = [];

while ($row = $result_minor->fetch_assoc()) {
    $minor_violations[] = $row;
}

while ($row = $result_major->fetch_assoc()) {
    $major_violations[] = $row;
}

// Determine the maximum number of rows (minor or major)
$max_rows = max(count($minor_violations), count($major_violations));

// Define the name of the CSV file
$filename = "violation_report_" . date('Ymd') . ".csv";

// Set headers for file download
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="' . $filename . '"');

// Open output stream
$output = fopen('php://output', 'w');

// Write the header row (for both minor and major violations)
fputcsv($output, [
    'Minor Violations', '', '', '', '', '', '', '', '', '', '',  // Minor violation headers
    'Major Violations', '', '', '', '', '', '', '', '', '', ''  // Major violation headers
]);

fputcsv($output, [
    'Violation Type', 'Slip No', 'First Name', 'Last Name', 'Student ID', 'Course', 'Violation', 'Comment', 'Date of Apprehension', 'Status', '', // One empty cell for spacing
    'Violation Type', 'Slip No', 'First Name', 'Last Name', 'Student ID', 'Course', 'Violation', 'Comment', 'Date of Apprehension', 'Status'
]);

// Write the rows
for ($i = 0; $i < $max_rows; $i++) {
    // Get minor violation data (or empty if there are no more rows)
    $minor_row = isset($minor_violations[$i]) ? $minor_violations[$i] : ['','','','','','','','','',''];

    // Get major violation data (or empty if there are no more rows)
    $major_row = isset($major_violations[$i]) ? $major_violations[$i] : ['','','','','','','','','',''];

    // Combine both into a single row, with one empty cell in between, and write it
    fputcsv($output, array_merge(
        [
            $minor_row['violation_type'] ?? '',
            $minor_row['slip_no'] ?? '',
            $minor_row['name'] ?? '',
            $minor_row['lastname'] ?? '',
            $minor_row['student_id'] ?? '',
            $minor_row['course_name'] ?? '',
            $minor_row['violation_name'] ?? '',
            $minor_row['comment'] ?? '',
            $minor_row['date_of_apprehension'] ?? '',
            $minor_row['status'] ?? ''
        ],
        [''], // Add empty cell for spacing
        [
            $major_row['violation_type'] ?? '',
            $major_row['slip_no'] ?? '',
            $major_row['name'] ?? '',
            $major_row['lastname'] ?? '',
            $major_row['student_id'] ?? '',
            $major_row['course_name'] ?? '',
            $major_row['violation_name'] ?? '',
            $major_row['comment'] ?? '',
            $major_row['date_of_apprehension'] ?? '',
            $major_row['status'] ?? ''
        ]
    ));
}

// Close the file pointer
fclose($output);

// Close the database connection
$conn->close();
?>