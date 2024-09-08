<?php

include '../../database/database_conn.php';

$employee_id = $_POST['employee_id'];
$title = $_POST['title'];
$message = $_POST['message'];
$recipient = $_POST['department'];



$sql = "INSERT INTO tbl_announcement(employee_id,title,message,recipients,date_sent) 
        VALUES($employee_id,'$title','$message','$recipient',NOW())";
$result = $conn->query($sql);

echo 'success';
$conn->close();
