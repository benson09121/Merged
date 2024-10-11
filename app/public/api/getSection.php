<?php

include '../database/database_conn.php';

$course = $_POST['course'];

$sql = "SELECT * 
        FROM sql12729827.tbl_section_info
        WHERE course_id = $course OR course_id is null
        ORDER BY course_id"
;

$result = mysqli_query($conn, $sql);
$final_data = [];
if (mysqli_num_rows($result) >= 1) {


    $index = 0;


    while ($row = mysqli_fetch_assoc($result)) {

        $final_data[$index] = [
            'sectionId' => $row["section_id"],
            'sectionName' => $row["name"]
        ];

        $index++;
    }
}
header('Content-type: application/json; charset=utf-8');
header("HTTP/1.0 200 goods");
echo json_encode(['status' => 'Success', 'message' => 'Pick your poison', 'section' => $final_data]);


mysqli_close($conn);
