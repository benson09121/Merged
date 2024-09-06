<?php
session_start();
include ('../database/database_conn.php');

$username = $_POST['username'];
$password = $_POST['password'];


if(empty($username) || empty($password)){
    print('empty');

} else{
    $sql = 'select * from tbl_admin_info';
    $result = $conn->query($sql);

    if($result->num_rows > 0 && $result !== FALSE){
        $row = mysqli_fetch_assoc($result);
        if($row['username'] === $username){
        if($row['password'] == $password){
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['employee_id'] = $row['employee_id'];
            print('success');
            exit();
    
        }
        else{
            print('Invalid');
            exit();
        }
        }
        else{
            print('Invalid');
            exit();
        }
        
    }
    else{
        print('Invalid');
        exit();
    }
}


?>