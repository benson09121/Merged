<?php
include "../../database/database_conn.php";

$violation_id = $_POST['id'];
$violation_name = $_POST['violation_name'];
$violation_description = $_POST['description'];

if ($violation_name == 'minor') {
    $sql = "UPDATE tbl_minor_violations SET violation_name = ? WHERE violation_id = ?";
} else if ($violation_name == 'major') {
    $sql = "UPDATE tbl_major_violation SET violation_name = ? WHERE violation_id = ?";
} else {
    echo "Invalid violation type.";
    $conn->close();
    exit();
}

$stmt = $conn->prepare($sql);
$stmt->bind_param('si', $violation_description, $violation_id);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "Error updating record: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>