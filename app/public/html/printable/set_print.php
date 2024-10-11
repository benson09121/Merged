<?php
session_start();


$_SESSION['category'] = $_POST['category'];

$_SESSION['type'] = $_POST['type'];


$violations = $_SESSION['violations'] ?? [];

$violationsJson = json_encode($violations, JSON_PRETTY_PRINT);

echo $violationsJson;
