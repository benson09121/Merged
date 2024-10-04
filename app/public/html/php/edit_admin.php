<?php
include ('../../database/database_conn.php');

$username = $_POST['username'];
$password = $_POST['password'];
$id = $_POST['id'];

$sql = 'UPDATE tbl_admin_info SET username = ?, password = ? WHERE employee_id = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssi', $username, $password, $id);
$stmt->execute();
echo 'Success';
