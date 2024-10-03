<?php
session_start();
include '../../database/database_conn.php';

$id = $_POST['id'];
$reqType = $_POST['reqType'];
$admin = $_SESSION['employee_id'];

date_default_timezone_set('Asia/Manila');
$dt = date('Y-m-d');

if ($reqType == "admission") {

    $sql = "UPDATE `sql12729827`.`tbl_request_admissionpass` SET `date_surrendered` = '$dt', `admin_incharge` = '$admin' WHERE (`request_no` = '$id');
";

} else if ($reqType == "entry") {

    $sql = "UPDATE `sql12729827`.`tbl_request_entrypass` SET `date_surrendered` = '$dt', `admin_incharge` = '$admin'  WHERE (`request_no` = '$id');
";

}

$result = $conn->query($sql);

if ($result) {
    echo "success";
} else {
    echo "failed";
}
$conn->close();
