<?php
include '../../database/database_conn.php';

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$email_password = $_POST['email_password'];

$sql = "UPDATE tbl_admin_info SET username = '$username', password = '$password', outlook_email = '$email', outlook_password = '$email_password'";
$result = $conn->query($sql);

if($result){
    echo 'Success';
}
else{
    echo 'Failed';
}