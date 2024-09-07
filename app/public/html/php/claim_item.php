<?php
include '../../database/database_conn.php';


$date = date('Y-m-d');

$sql = "INSERT INTO   tbl_claimed_items(item_no,claimed_by,date,released_by) VALUES ('".$_POST['item_no']."','".$_POST['claimed_by']."','".$date."','".$_POST['released_by']."')";
$result = $conn->query($sql);

if($result){
    echo "success";
}
else{
    echo "failed";
}