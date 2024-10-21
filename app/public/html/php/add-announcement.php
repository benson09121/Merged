<?php
include '../../database/database_conn.php';

$employee_id = $_POST['employee_id'];
$title = $_POST['title'];
$message = $_POST['message'];
$recipient = $_POST['department'];

$targetDir = __DIR__ . '../../../image_announcement/'; // Directory for storing uploaded announcement images

if (!file_exists($targetDir)) {
    mkdir($targetDir, 0775, true);
}

$photoFileName = null; // Initialize photo file name

// Check if a file is uploaded
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $photoFileName = basename($_FILES['image']['name']);
    $targetFile = $targetDir . $photoFileName;

    // Move the uploaded file to the target directory
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        echo 'error';
        $conn->close();
        exit();
    }
}

// Insert data into the `tbl_announcement` table, including the photo if uploaded
$stmt = $conn->prepare("INSERT INTO tbl_announcement (employee_id, title, message, recipients, date_sent, image) VALUES (?, ?, ?, ?, NOW(), ?)");
$stmt->bind_param('issss', $employee_id, $title, $message, $recipient, $photoFileName);

if ($stmt->execute()) {
    echo 'success';
} else {
    echo 'error';
}

$stmt->close();
$conn->close();
?>
