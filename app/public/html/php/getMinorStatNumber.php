<?php

include '../../database/database_conn.php';


// department
$sql = "SELECT info.short_desc, COUNT(record.slip_no) as count
            FROM sql12729827.tbl_minor_violation_records as record
            INNER JOIN sql12729827.tbl_minor_violations as info
            ON record.violation_id = info.violation_id
            GROUP BY info.short_desc
            ORDER BY count
            ";

$res = mysqli_query($conn, $sql);
$final_data = [];
$final_label = [];

if (mysqli_num_rows($res) >= 1) {

    $index = 0;

    while ($row = mysqli_fetch_assoc($res)) {

        // $data = [$row["count"]];
        $count = $row["count"];
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
