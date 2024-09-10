<?php
session_start();
include '../../database/database_conn.php';

$id = $_POST['id'];
$reqType = $_POST['reqType'];

if ($reqType == "goodmoral") {

    $sql = "DELETE FROM tbl_request_goodmoral WHERE request_no = '$id'";

} else if ($reqType == "admission") {

    $sql = "DELETE FROM tbl_request_admissionpass WHERE request_no = '$id'";

} else if ($reqType == "entry") {

    $sql = "DELETE FROM tbl_request_entrypass WHERE request_no = '$id'";

}

$result = $conn->query($sql);

if ($result) {
    echo "success";
} else {
    echo "failed";
}
$conn->close();
