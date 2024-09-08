<?php
session_start();
include '../../database/database_conn.php';
$id = $_POST['id'];



if($id == 0){
    $sql = "SELECT * FROM tbl_school_info";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($rows);
}else{
    $sql = "SELECT * FROM tbl_department_info WHERE school_id='$id'";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($rows);
}
$conn->close();
?>