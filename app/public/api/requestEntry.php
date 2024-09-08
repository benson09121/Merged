<?php

    include '../database/database_conn.php';

    $studID = $_POST['studID'];
    $purpose = $_POST['purpose'];
    $reason = $_POST['reason'];
    $date_requested = $_POST['date_requested'];
    

    // request entry
    $sql = "INSERT INTO `sql12729827`.`tbl_request_entrypass` (`student_id`, `purpose`, `reason`, `date_requested`, `status`) VALUES ('". $studID ."', '". $purpose ."', '". $reason ."', '". $date_requested ."', 'Pending')";

    mysqli_query($conn, $sql);

    mysqli_close($conn);
    
?>