<?php

include '../database/database_conn.php';

$studID = $_POST['studID'];

$sql = "SELECT records.slip_no, penalty.penalty_name, info.violation_name, records.date_of_apprehension, records.comment, intervention.method, intervention.assigned_department, intervention.compliance_due_date, intervention.status, conf.ref_id as conferenceNo,conf.scheduled_date as conf_date, conf.conference_type, conf.status as conf_status
    FROM sql12729827.tbl_major_violation_records as records
    INNER JOIN sql12729827.tbl_major_violation as info
    ON records.violation_id = info.violation_id
    INNER JOIN sql12729827.tbl_penalty_info as penalty
    ON records.penalty_id = penalty.penalty_id
    INNER JOIN sql12729827.tbl_major_violation_types as types
    ON info.violation_type_id = types.violation_type_id
    INNER JOIN sql12729827.tbl_for_intervention as intervention
    ON records.slip_no = intervention.slip_no
    LEFT JOIN sql12729827.tbl_for_conference as conf
    ON records.slip_no = conf.slip_no
    WHERE records.student_id = '" . $studID . "'";

$result = mysqli_query($conn, $sql);
$final_data = [];
if (mysqli_num_rows($result) >= 1) {

    $index = 0;

    while ($row = mysqli_fetch_assoc($result)) {

        $data = [
            'slip_no' => $row["slip_no"],
            'category' => $row["penalty_name"],
            'violation_name' => $row["violation_name"],
            'comment' => $row["comment"],
            'date_of_apprehension' => $row["date_of_apprehension"],
            'int_method' => $row["method"],
            'assigned_dept' => $row["assigned_department"],
            'compliance_due_date' => $row["compliance_due_date"],
            'int_status' => $row["status"],
            'conferenceNo' => $row["conferenceNo"],
            'conf_date' => $row["conf_date"],
            'conf_type' => $row["conference_type"],
            'conf_status' => $row["conf_status"],

        ];


        $final_data[$index] = $data;
        $index++;
    }
}
header('Content-type: application/json; charset=utf-8');
echo '{"results": ' . json_encode($final_data) . "}";


mysqli_close($conn);
?>