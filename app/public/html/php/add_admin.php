<?php
include ('../../database/database_conn.php');

$username = $_POST['username'];
$password = $_POST['password'];
$role = 'Admin';


$hashed = password_hash($password, PASSWORD_BCRYPT);

$sql = 'INSERT INTO tbl_admin_info (username, password, role) VALUES (?, ?, ?)';
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $username, $hashed, $role);
$stmt->execute();
echo 'Success';