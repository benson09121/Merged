<?php
include ('../../database/database_conn.php');

$username = $_POST['username'];
$password = $_POST['password'];
$role = 'Admin';

$sql = 'INSERT INTO tbl_admin_info (username, password, role) VALUES (?, ?, ?)';
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $username, $password, $role);
$stmt->execute();
echo 'Success';