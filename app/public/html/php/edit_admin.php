<?php
include ('../../database/database_conn.php');

$username = $_POST['username'];
$password = $_POST['password'];
$id = $_POST['id'];

$hashed = password_hash($password, PASSWORD_BCRYPT);

$sql = 'UPDATE tbl_admin_info SET username = ?, password = ? WHERE employee_id = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssi', $username, $hashed, $id);
$stmt->execute();
echo 'Success';
