<?php

include '../database/database_conn.php';



$sql = "SELECT * FROM sql12729827.tbl_course_info;";

$result = mysqli_query($conn, $sql);
$final_data = [];
if (mysqli_num_rows($result) >= 1) {


    $index = 0;


    while ($row = mysqli_fetch_assoc($result)) {

        $final_data[$index] = [
            'courseId' => $row["course_id"],
            'courseName' => $row["name"]
        ];

        $index++;
    }
}
header('Content-type: application/json; charset=utf-8');
header("HTTP/1.0 200 goods");
echo json_encode(['status' => 'Success', 'message' => 'Pick your poison', 'course' => $final_data]);


mysqli_close($conn);
