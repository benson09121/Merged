<?php

include '../database/database_conn.php';

$conferenceNo = $_POST['conferenceNo'];

$sql = "SELECT name
        FROM sql12729827.tbl_conf_attendees as attendees
        WHERE conference_no = '$conferenceNo'"
;

$result = mysqli_query($conn, $sql);
$final_data = [];
if (mysqli_num_rows($result) >= 1) {

    $index = 0;

    while ($row = mysqli_fetch_assoc($result)) {

        $final_data[$index] = [
            'attendee_name' => $row["name"],
        ];

        $index++;
    }
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($final_data);


mysqli_close($conn);
?>