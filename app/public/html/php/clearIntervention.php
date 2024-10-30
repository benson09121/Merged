<?php

include '../../database/database_conn.php';

$ref_id = trim($_POST['ref_id']);

$sql = "UPDATE `sql12729827`.`tbl_for_intervention` SET `status` = 'Cleared' WHERE (`ref_id` = '$ref_id');";


mysqli_query($conn, $sql);





mysqli_close($conn);
