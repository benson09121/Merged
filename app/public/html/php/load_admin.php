<?php
include ('../../database/database_conn.php');


$sql = 'select * from tbl_admin_info';
$result = $conn->query($sql);

$admin = array();
if($result->num_rows > 0 && $result !== FALSE){
    while($row = mysqli_fetch_assoc($result)){
        if($row['role'] == 'Admin'){
        $admin[] = $row;
        }
    }
    echo json_encode($admin);
}
else{
    echo json_encode('No Admin');
}
