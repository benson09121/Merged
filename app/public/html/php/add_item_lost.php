<?php
include '../../database/database_conn.php';

$founder_name = $_POST['founder_name'];
$item_type = $_POST['item_type'];
$description = $_POST['description'];
$item_found = $_POST['item_found'];
$date_found = $_POST['date_found'];

$targetDir = __DIR__ . '/new_items/';


if (!file_exists($targetDir)) {
    mkdir($targetDir, 0775, true);
}


if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $fileName = basename($_FILES['image']['name']);
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
      
        $stmt = $conn->prepare("INSERT INTO tbl_lost_items (name, description, location_found, image, founder, date_found) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssss', $item_type, $description, $item_found, $fileName, $founder_name, $date_found);

        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'error'; 
    }
} else {
    echo 'error'; 
}
$conn->close();
