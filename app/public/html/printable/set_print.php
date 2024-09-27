<?php
session_start();

$_SESSION['student_id'] = $_POST['student_id'];
$_SESSION['category'] = $_POST['choice'];
$_SESSION['type'] = $_POST['type'];
$_SESSION['offense_type'] = $_POST['offense_type'];
$_SESSION['name'] = $_POST['name'];
$_SESSION['section'] = $_POST['section'];
$_SESSION['course'] = $_POST['course'];
