<?php

include '../../database/database_conn.php';


// 
$sql = "SELECT info.short_desc, COUNT(record.slip_no) as No_of_violations
            FROM sql12729827.tbl_major_violation_records as record
            INNER JOIN sql12729827.tbl_major_violation as info
            ON record.violation_id = info.violation_id
            GROUP BY info.short_desc
            ORDER BY No_of_violations
            ";

$res = mysqli_query($conn, $sql);
$final_data = [];
$final_label = [];

if (mysqli_num_rows($res) >= 1) {

    $index = 0;

    while ($row = mysqli_fetch_assoc($res)) {

        // $data = [$row["count"]];
        $count = $row["No_of_violations"];
        $label = $row["short_desc"];

        $final_data[$index] = (int) $count;
        $final_label[$index] = $label;
        $index++;
    }
}

// $final_dept = json_encode($final_data);


header('Content-type: application/json; charset=utf-8');
echo "[" . json_encode($final_data) . "," . json_encode($final_label) . "]";


mysqli_close($conn);
