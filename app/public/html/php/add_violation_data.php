<?php
include '../../database/database_conn.php';

$offense_type = $_POST['offense'];
$violation_type = $_POST['violation_type'];
$description = $_POST['description'];


if($offense_type == 'minor'){
    $sql = "INSERT INTO tbl_minor_violations (violation_name) VALUES ('$description')";
}
else if($offense_type == 'major'){
    $sql = "INSERT INTO tbl_major_violation (violation_name, violation_type_id) VALUES ('$description', '$violation_type')";
}

$result = $conn->query($sql);

if($result){
    echo "success";
}
else{
    echo "failed";
}

mysqli_close($conn);