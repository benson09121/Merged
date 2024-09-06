<?php
session_start();
include '../../database/database_conn.php';

$id = $_POST['id'];
$type = $_POST['type'];

if($type == "minor"){

    $sql = "DELETE FROM tbl_minor_violations WHERE violation_id = '$id'";
}
else if($type == "major"){

    $sql = "DELETE FROM tbl_major_violation WHERE violation_id = '$id'";
}

$result = $conn->query($sql);

if($result){
    echo "success";
}
else{
    echo "failed";
}
