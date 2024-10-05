<?php
header('Content-type: application/json; charset=utf-8');
include '../database/database_conn.php';

$studID = trim($_POST['studID']);
$email = trim($_POST['email']);

$sql = "SELECT * 
        FROM sql12729827.tbl_student_info
        WHERE student_id='$studID' && email='$email'";

$result = mysqli_query($conn, $sql);
// $final_data = [];
if (mysqli_num_rows($result) >= 1) {


    // $row = mysqli_fetch_assoc($result);

    // $final_data = [
    //     'email' => $row["course_id"],
    //     'studId' => $row["student_id"]
    // ];
    header("HTTP/1.0 200 goods");
    echo json_encode(['status' => 'Success', 'message' => 'Account exists']);

} else {
    header("HTTP/1.0 200 goods");
    echo json_encode(['status' => 'Fail', 'message' => 'Account doesn\'t exists']);
}




mysqli_close($conn);
