<?php
include '../../database/database_conn.php';

$sql = "SELECT * FROM tbl_announcement ORDER BY date_sent DESC";
$result = $conn->query($sql);

$announce = array();
while($row = $result->fetch_assoc()){
    $announce[] = $row;
}

echo json_encode($announce);
?>
