<?php
$db_server = "sql12.freesqldatabase.com";
$db_user = "sql12729827";
$db_pass = "q6PMIy6VXQ";
$db_name = "sql12729827";

// Establishing the mysqli connection
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
