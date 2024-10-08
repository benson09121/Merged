<?php
include '../../database/database_conn.php';

$from = $_POST['from'] ?? '';
$to = $_POST['to'] ?? '';

// Get lost items that are not yet claimed
$sql = "SELECT *
FROM tbl_lost_items l
WHERE NOT EXISTS (
    SELECT 1
    FROM tbl_claimed_items c
    WHERE c.item_no = l.item_no
)";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $lost_items = array();
    while ($row = $result->fetch_assoc()) {
        $lost_items[] = $row;
    }
} else {
    $lost_items = 'No data';
}

// Get claimed items
$sql = "SELECT 
    l.item_no,
    l.name,
    l.description,
    l.location_found,
    l.image,
    l.founder,
    l.date_found,
    c.claimed_by,
    c.date AS date_claimed,
    c.released_by
FROM 
    tbl_claimed_items c
JOIN 
    tbl_lost_items l ON l.item_no = c.item_no";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $claimed_items = array();
    while ($row = $result->fetch_assoc()) {
        $claimed_items[] = $row;
    }
} else {
    $claimed_items = 'No data';
}

// Check if both $from and $to dates are provided and not empty
if (!empty($from) && !empty($to) && $from != 'undefined' && $to != 'undefined') {
    $sql = "SELECT 
    l.item_no,
    l.name,
    l.description,
    l.location_found,
    l.image,
    l.founder,
    l.date_found,
    NULL AS claimed_by,
    NULL AS date_claimed,
    NULL AS released_by,
    'surrendered' AS status
FROM 
    tbl_lost_items l
LEFT JOIN 
    tbl_claimed_items c ON l.item_no = c.item_no
WHERE 
    c.item_no IS NULL AND DATE(l.date_found) BETWEEN '$from' AND '$to'

UNION ALL

-- For Claimed Items
SELECT 
    l.item_no,
    l.name,
    l.description,
    l.location_found,
    l.image,
    l.founder,
    l.date_found,
    c.claimed_by,
    c.date AS date_claimed,
    c.released_by,
    'claimed' AS status
FROM 
    tbl_claimed_items c
JOIN 
    tbl_lost_items l ON l.item_no = c.item_no
WHERE 
    DATE(l.date_found) BETWEEN '$from' AND '$to'";
} else {
    // Default query without date filter
    $sql = "SELECT 
    l.item_no,
    l.name,
    l.description,
    l.location_found,
    l.image,
    l.founder,
    l.date_found,
    NULL AS claimed_by,
    NULL AS date_claimed,
    NULL AS released_by,
    'surrendered' AS status
FROM 
    tbl_lost_items l
LEFT JOIN 
    tbl_claimed_items c ON l.item_no = c.item_no
WHERE 
    c.item_no IS NULL

UNION ALL

-- For Claimed Items
SELECT 
    l.item_no,
    l.name,
    l.description,
    l.location_found,
    l.image,
    l.founder,
    l.date_found,
    c.claimed_by,
    c.date AS date_claimed,
    c.released_by,
    'claimed' AS status
FROM 
    tbl_claimed_items c
JOIN 
    tbl_lost_items l ON l.item_no = c.item_no";
}

// Execute the summary query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $items = array();
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
} else {
    $items = 'No data';
}

// Get the count of lost items
$sql = "SELECT COUNT(*) AS lost_items FROM tbl_lost_items";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
$number_lost_items = $row['lost_items'];

// Get the count of claimed items
$sql = "SELECT COUNT(*) AS claimed_items FROM tbl_claimed_items";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
$number_claimed_items = $row['claimed_items'];

// Calculate the total number of items
$number_all_items = $number_lost_items + $number_claimed_items;

// Prepare the final response data
$data = [
    'lost_items' => $lost_items,
    'claimed_items' => $claimed_items,
    'summary' => $items,
    'number_lost_items' => $number_lost_items,
    'number_claimed_items' => $number_claimed_items,
    'number_all_items' => $number_all_items
];

echo json_encode($data);
$conn->close();