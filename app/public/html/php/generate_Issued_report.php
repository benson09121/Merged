<?php
include '../../database/database_conn.php';

// Set headers to download the file as CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=issued_report.csv');

// Open the output stream
$output = fopen('php://output', 'w');

// Write the column headers for each table
$headers_admissionpass = ['Admission Pass Request No', 'Admission Pass Student ID', 'Admission Pass Purpose', 'Admission Pass Reason', 'Admission Pass Status', 'Admission Pass Date Surrendered'];
$headers_entrypass = ['Entry Pass Request No', 'Entry Pass Student ID', 'Entry Pass Purpose', 'Entry Pass Reason', 'Entry Pass Date Requested', 'Entry Pass Valid Until', 'Entry Pass Status', 'Entry Pass Date Surrendered'];
$headers_goodmoral = ['Good Moral Request No', 'Good Moral Student ID', 'Good Moral Reason', 'Good Moral Proof of Payment', 'Good Moral Date Requested', 'Good Moral Status', 'Good Moral Date Released'];

// Write the combined headers to the CSV file
fputcsv($output, array_merge($headers_admissionpass, ['', '', ''], $headers_entrypass, ['', '', ''], $headers_goodmoral));

// Function to fetch data and write to CSV
function fetchDataAndWriteToCSV($conn, $sql) {
    $result = $conn->query($sql);
    $data = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = array_values($row);
        }
    } else {
        echo 'SQL Error: ' . $conn->error;
    }
    return $data;
}

// Fetch data from each table
$data_admissionpass = fetchDataAndWriteToCSV($conn, "SELECT request_no, student_id, purpose, reason, status, date_surrendered FROM tbl_request_admissionpass");
$data_entrypass = fetchDataAndWriteToCSV($conn, "SELECT request_no, student_id, purpose, reason, date_requested, valid_until, status, date_surrendered FROM tbl_request_entrypass");
$data_goodmoral = fetchDataAndWriteToCSV($conn, "SELECT request_no, student_id, reason, proof_of_payment, date_requested, status, date_released FROM tbl_request_goodmoral");

// Determine the maximum number of rows
$max_rows = max(count($data_admissionpass), count($data_entrypass), count($data_goodmoral));

// Write the data to the CSV file, aligning horizontally with two cells apart
for ($i = 0; $i < $max_rows; $i++) {
    $row = array_merge(
        isset($data_admissionpass[$i]) ? $data_admissionpass[$i] : ['', '', '', '', '', ''],
        ['', '', ''], // Two cells apart
        isset($data_entrypass[$i]) ? $data_entrypass[$i] : ['', '', '', '', '', '', '', ''],
        ['', '', ''], // Two cells apart
        isset($data_goodmoral[$i]) ? $data_goodmoral[$i] : ['', '', '', '', '', '', '']
    );
    fputcsv($output, $row);
}

// Close the database connection
$conn->close();
?>