<?php

// include '../database/database_conn.php';
// include '../../database/database_conn.php';


$sqlconf = "SELECT conf.ref_id, stu.student_id, conf.slip_no, conf.conference_type, conf.scheduled_date, conf.status
        FROM sql12729827.tbl_for_conference conf
        INNER JOIN sql12729827.tbl_major_violation_records rec
        ON conf.slip_no = rec.slip_no
        INNER JOIN sql12729827.tbl_student_info stu
        ON rec.student_id = stu.student_id
";


$resultconf = mysqli_query($conn, $sqlconf);
$dataConference = [];

foreach ($resultconf as $row) {

    $dataConference[] = [

        'ref_id' => $row['ref_id'],
        'student_id' => $row['student_id'],
        'slip_no' => $row['slip_no'],
        'conference_type' => $row['conference_type'] ?? '',
        // 'department' => $row['assigned_department'] ?? '--',
        'scheduled_date' => $row['scheduled_date'],
        'status' => $row['status']
    ];

}


$sqlAttendees = "SELECT * FROM sql12729827.tbl_conf_attendees";

$resultAttendees = mysqli_query($conn, $sqlAttendees);
$dataAttendees = [];

foreach ($resultAttendees as $row) {

    $dataAttendees[] = [

        'conf_no' => $row['conference_no'],
        'name' => $row['name']

    ];

}












mysqli_close($conn);
