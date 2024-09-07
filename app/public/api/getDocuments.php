<?php

    include '../database/database_conn.php';

    $studID = $_POST['studID'];

    // entry pass
    $sql1 = "SELECT * FROM sql12729827.tbl_request_entrypass WHERE student_id ='". $studID . "'";
    $entry_array = [];
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) >= 1) {
    
        $index=0;
    
        while($row = mysqli_fetch_assoc($result1)) {

            $data1 = [ 'request_no' => 'ENT-'.$row["request_no"], 
                        'doc_type' => 'Entry Pass',
                        'purpose' => $row["purpose"],
                        'reason' => $row["reason"],
                        'date_requested' => $row["date_requested"],
                        'valid_until' => $row["valid_until"],
                        'status' => $row["status"],
                        'admin_incharge' => $row["admin_incharge"],
                        'proof_of_payment' => '',
                    ];
            $entry_array[$index] = $data1;
            $index ++ ;
        }
    }

    // admission pass

    $sql2 = "SELECT * FROM sql12729827.tbl_request_admissionpass WHERE student_id ='". $studID . "'";
    $admission_array = [];
    $result2 = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($result2) >= 1) {

        $final_data = [];
        $index=0;
    
        while($row = mysqli_fetch_assoc($result2)) {

            $data2 = [ 'request_no' => 'ADM-'.$row["request_no"], 
                        'doc_type' => 'Admission Pass',
                        'purpose' => $row["purpose"],
                        'reason' => $row["reason"],
                        'date_requested' => $row["date_requested"],
                        'valid_until' => '',
                        'status' => $row["status"],
                        'admin_incharge' => $row["admin_incharge"],
                        'proof_of_payment' => '',
                    ];

            $admission_array[$index] = $data2;
            $index ++ ;
        }
    
    }


    // good moral cert

    $sql3 = "SELECT * FROM sql12729827.tbl_request_goodmoral WHERE student_id ='". $studID . "'";
    $goodmoral_array = [];
    $result3 = mysqli_query($conn, $sql3);
    if (mysqli_num_rows($result3) >= 1) {

        $index=0;
    
        while($row = mysqli_fetch_assoc($result3)) {

            $data3 = [ 'request_no' => 'GMC-'.$row["request_no"], 
                        'doc_type' => 'Good Moral Certificate',
                        'purpose' => '',
                        'reason' => $row["reason"],
                        'date_requested' => $row["date_requested"],
                        'valid_until' => '',
                        'status' => $row["status"],
                        'admin_incharge' => $row["admin_incharge"],
                        'proof_of_payment' => $row["proof_of_payment"],
                        'date_released' => $row["date_released"],
                    ];

            $goodmoral_array[$index] = $data3;
            $index ++ ;
        }
    }

    $all = array_merge($entry_array, $admission_array, $goodmoral_array);


    header('Content-type: application/json; charset=utf-8');
    echo '{"results": '. json_encode( $all )."}";


    mysqli_close($conn);
?>