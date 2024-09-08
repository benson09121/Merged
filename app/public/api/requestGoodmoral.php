<?php


    include '../database/database_conn.php';

    $base64 = $_POST['base64'];
    $studID = $_POST['studID'];
    $reason = $_POST['reason'];
    $date_requested = $_POST['date_requested'];

    $sqlInsert = "INSERT INTO `sql12729827`.`tbl_request_goodmoral` (`student_id`, `reason`, `date_requested`, `status`) VALUES ('".$studID."', '".$reason."', '".$date_requested."', 'Pending')";

    mysqli_query($conn, $sqlInsert);

    $sqlGetRequestNo = "SELECT * FROM sql12729827.tbl_request_goodmoral WHERE student_id = '".$studID."' && proof_of_payment IS NULL";
    $result = mysqli_query($conn, $sqlGetRequestNo);
    $requestNo = 0;

    if (mysqli_num_rows($result) == 1) {

        while($row = mysqli_fetch_assoc($result)) {
            $requestNo = $row["request_no"];
        }

    }
    $directory = '../proof_of_payments/';
    $fileName = $requestNo . '_' . $studID . '.png';
    
    $sqlUpdate = "UPDATE `sql12729827`.`tbl_request_goodmoral` SET `proof_of_payment` = '".$fileName."' WHERE (`request_no` = '".$requestNo."')";
    mysqli_query($conn, $sqlUpdate);
    
    $filePath = $directory . $fileName;
    $decodedbase64 = base64_decode($base64);  
     if ($decodedBase64) {
        $filePath = $directory . $fileName;
        if (file_put_contents($filePath, $decodedBase64)) {
            echo "File successfully saved as " . $filePath;
        } else {
            echo "Failed to save the file.";
        }
    } else {
        echo "Invalid base64 string.";
    }
} else {
    echo "Missing base64 content or file name.";
}

    mysqli_close($conn);

?>
