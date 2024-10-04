<?php
include ('../../database/database_conn.php');

$id = $_POST['id'];

$sql = 'DELETE FROM tbl_admin_info WHERE employee_id = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
echo 'Success';