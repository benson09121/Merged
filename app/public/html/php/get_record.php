<?php
include '../../database/database_conn.php';

$student_id = $_POST['student_id'];

$sql = "SELECT * FROM tbl_request_goodmoral WHERE student_id = '$student_id'";
$result = $conn->query($sql);

if($result->num_rows > 0){
    $goodmoral = array();
    while($row = $result->fetch_assoc()){
        $goodmoral[] = $row;
    }
    
}
else{
    $goodmoral = 'No data';
}

$sql = "SELECT * FROM tbl_request_admissionpass WHERE student_id = '$student_id'";
$result = $conn->query($sql);

if($result->num_rows > 0){
    $admissionpass = array();
    while($row = $result->fetch_assoc()){
        $admissionpass[] = $row;
    }
    
}
else{
    $admissionpass = 'No data';
}

$sql = "SELECT * FROM tbl_request_entrypass WHERE student_id = '$student_id'";
$result = $conn->query($sql);
if($result->num_rows > 0){
    $entrypass = array();
    while($row = $result->fetch_assoc()){
        $entrypass[] = $row;
    }
    
}
else{
    $entrypass = 'No data';
}

$data  = [
    'goodmoral' => $goodmoral,
    'admissionpass' => $admissionpass,
    'entrypass' => $entrypass
];

echo json_encode($data);