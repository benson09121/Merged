<?php
header('Content-type: application/json; charset=utf-8');
include '../database/database_conn.php';

$studID = trim($_POST['studID']);
$password = trim($_POST['password']);

$hashedPass = password_hash($password, PASSWORD_DEFAULT);



$sql = "UPDATE `sql12729827`.`tbl_student_info` 
        SET `password` = '$hashedPass' 
        WHERE (`student_id` = '$studID');
";

if (mysqli_query($conn, $sql)) {

    header("HTTP/1.0 200 goods");
    echo json_encode(['status' => 'Success', 'message' => 'Password changed successfully']);

} else {
    header("HTTP/1.0 200 goods");
    echo json_encode(['status' => 'Fail', 'message' => 'Failed to recover account']);
}


mysqli_close($conn);
