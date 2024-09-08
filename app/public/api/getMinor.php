<?php

    include '../database/database_conn.php';

    $studID = $_POST['studID'];
  
    $sql = "SELECT records.slip_no, info.violation_name, records.comment, records.date_of_apprehension, records.status
            FROM sql12729827.tbl_minor_violation_records as records
            INNER JOIN sql12729827.tbl_minor_violations as info
            ON records.violation_id = info.violation_id
            WHERE records.student_id = '". $studID ."'";

    $result = mysqli_query($conn, $sql);
    $final_data = [];
    if (mysqli_num_rows($result) >= 1) {

        $index=0;
         
        while($row = mysqli_fetch_assoc($result)) {

            $data = [ 'slip_no' => $row["slip_no"], 
                        'violation_name' => $row["violation_name"], 
                        'comment' => $row["comment"], 
                        'date_of_apprehension' => $row["date_of_apprehension"], 
                        'status' => $row["status"],                        
                    ];


            $final_data[$index] = $data;
            $index ++ ;
        }        
    } 
    header('Content-type: application/json; charset=utf-8');
    echo '{"results": '. json_encode( $final_data )."}";


    mysqli_close($conn);
?>