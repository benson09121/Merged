<?php
session_start();
include('../database/database_conn.php');

$username = $_POST['username'];
$password = $_POST['password'];

if (empty($username) || empty($password)) {
    print('empty');
} else {
    // Use a prepared statement to securely select the user record
    $sql = 'SELECT * FROM tbl_admin_info WHERE username = ? AND password = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists in the database
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['employee_id'] = $row['employee_id'];

        if ($row['role'] == 'Admin') {
            print('Success_Admin');
        } elseif ($row['role'] == 'ITSO') {
            print('Success_ITSO');
        }
    } else {
        print('Invalid');
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>
