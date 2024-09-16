<?php
// Database connection
include '../../database/database_conn.php';

// SQL query for surrendered items (unclaimed items)
$sql_surrendered = "
    SELECT 
        l.item_no,
        l.name,
        l.description,
        l.location_found,
        l.image,
        l.founder,
        l.date_found,
        'surrendered' AS status
    FROM 
        tbl_lost_items l
    LEFT JOIN 
        tbl_claimed_items c ON l.item_no = c.item_no
    WHERE 
        c.item_no IS NULL
";

// SQL query for claimed items
$sql_claimed = "
    SELECT 
        l.item_no,
        l.name,
        l.description,
        l.location_found,
        l.image,
        l.founder,
        l.date_found,
        'claimed' AS status
    FROM 
        tbl_claimed_items c
    JOIN 
        tbl_lost_items l ON l.item_no = c.item_no
";

// Execute both queries
$result_surrendered = $conn->query($sql_surrendered);
$result_claimed = $conn->query($sql_claimed);

// Fetch the results into arrays
$surrendered_items = [];
$claimed_items = [];

while ($row = $result_surrendered->fetch_assoc()) {
    $surrendered_items[] = $row;
}

while ($row = $result_claimed->fetch_assoc()) {
    $claimed_items[] = $row;
}

// Determine the maximum number of rows (surrendered or claimed)
$max_rows = max(count($surrendered_items), count($claimed_items));

// Define the name of the CSV file
$filename = "lost_and_found_report_" . date('Ymd') . ".csv";

// Set headers for file download
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="' . $filename . '"');

// Open output stream
$output = fopen('php://output', 'w');

// Write the header row (for both surrendered and claimed items, without claimed-related columns)
fputcsv($output, [
    'Surrendered Items', '', '', '', '', '', '', '', '',  // Surrendered item headers
    'Claimed Items', '', '', '', '', '', '', '', ''  // Claimed item headers
]);

fputcsv($output, [
    'Item No', 'Name', 'Description', 'Location Found', 'Image', 'Founder', 'Date Found', 'Status', '', // One empty cell for spacing
    'Item No', 'Name', 'Description', 'Location Found', 'Image', 'Founder', 'Date Found', 'Status'
]);

// Write the rows
for ($i = 0; $i < $max_rows; $i++) {
    // Get surrendered item data (or empty if there are no more rows)
    $surrendered_row = isset($surrendered_items[$i]) ? $surrendered_items[$i] : ['','','','','','','',''];

    // Get claimed item data (or empty if there are no more rows)
    $claimed_row = isset($claimed_items[$i]) ? $claimed_items[$i] : ['','','','','','','',''];

    // Combine both into a single row, with one empty cell in between, and write it
    fputcsv($output, array_merge(
        [
            $surrendered_row['item_no'] ?? '',
            $surrendered_row['name'] ?? '',
            $surrendered_row['description'] ?? '',
            $surrendered_row['location_found'] ?? '',
            $surrendered_row['image'] ?? '',
            $surrendered_row['founder'] ?? '',
            $surrendered_row['date_found'] ?? '',
            $surrendered_row['status'] ?? ''
        ],
        [''], // Add empty cell for spacing
        [
            $claimed_row['item_no'] ?? '',
            $claimed_row['name'] ?? '',
            $claimed_row['description'] ?? '',
            $claimed_row['location_found'] ?? '',
            $claimed_row['image'] ?? '',
            $claimed_row['founder'] ?? '',
            $claimed_row['date_found'] ?? '',
            $claimed_row['status'] ?? ''
        ]
    ));
}

// Close the file pointer
fclose($output);

// Close the database connection
$conn->close();
?>
