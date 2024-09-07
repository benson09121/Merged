<?php
include '../../database/database_conn.php';

$sql = "SELECT * FROM category_db";

$result = $conn->query($sql);

if($result->num_rows > 0){
    $data = array();
    while($row = $result->fetch_assoc()){
        $data[] = $row;
    }
    echo json_encode($data);
}
else{
    echo json_encode('No data');
}
