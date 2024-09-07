<?php
include '../../database/database_conn.php';


$sql = "SELECT *
FROM tbl_lost_items l
WHERE NOT EXISTS (
    SELECT 1
    FROM tbl_claimed_items c
    WHERE c.item_no = l.item_no
)";
$result = $conn->query($sql);

if($result->num_rows > 0){
    $lost_items = array();
    while($row = $result->fetch_assoc()){
        $lost_items[] = $row;
    }
    
}
else{
    $lost_items = 'No data';
}

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
    tbl_lost_items l ON l.item_no = c.item_no;";
$result = $conn->query($sql);
if($result->num_rows > 0){
    $claimed_items = array();
    while($row = $result->fetch_assoc()){
        $claimed_items[] = $row;
    }
    
}
else{
    $claimed_items = 'No data';
}

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

$result = $conn->query($sql);
if($result->num_rows > 0){
    $items = array();
    while($row = $result->fetch_assoc()){
        $items[] = $row;
    }
    
}
else{
    $items = 'No data';
}



$data  = [
    'lost_items' => $lost_items,
    'claimed_items' => $claimed_items,
    'summary' => $items
];

echo json_encode($data);
mysqli_close($conn);
