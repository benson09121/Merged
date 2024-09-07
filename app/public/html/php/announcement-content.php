<?php
include '../../database/database_conn.php';

$sql = "SELECT * FROM tbl_school_info";

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

mysqli_close($conn);
?>