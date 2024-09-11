<?php
session_start();
include '../../database/database_conn.php';

$id = $_POST['id'];
$reqType = $_POST['reqType'];
$status = $_POST['status'];
$admin = $_POST['admin'];
$date = $_POST['date'];



if ($reqType == "goodmoral") {

    $sql = "UPDATE `sql12729827`.`tbl_request_goodmoral` SET `status` = '$status',`admin_incharge` = '$admin' WHERE (`request_no` = '$id')";

} else if ($reqType == "entry") {

    if ($status != 'Accepted') {
        $sql = "UPDATE `sql12729827`.`tbl_request_entrypass` SET `status` = '$status',`admin_incharge` = '$admin' WHERE (`request_no` = '$id')";
    } else {
        $sql = "UPDATE `sql12729827`.`tbl_request_entrypass` SET `status` = '$status',`admin_incharge` = '$admin',`valid_until` = '$date' WHERE (`request_no` = '$id')";
    }

} else if ($reqType == "admission") {

    $sql = "UPDATE `sql12729827`.`tbl_request_admissionpass` SET `status` = '$status',`admin_incharge` = '$admin' WHERE (`request_no` = '$id')";

}



$result = $conn->query($sql);

if ($result) {
    echo "success";
} else {
    echo "failed";
}
$conn->close();
