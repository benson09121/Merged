<?php
// header('Content-type: application/json; charset=utf-8');

// include('../../database/database_conn.php');


$sql = "SELECT intervention.ref_id, student.student_id, violation.slip_no, intervention.method, intervention.assigned_department, intervention.compliance_due_date
        FROM sql12729827.tbl_for_intervention as intervention
        INNER JOIN sql12729827.tbl_major_violation_records as violation
        ON intervention.slip_no = violation.slip_no
        INNER JOIN sql12729827.tbl_student_info as student
        ON student.student_id = violation.student_id
";

$output = array();

$result = mysqli_query($conn, $sql);
$data = array();
$filtered_row = $result->num_rows;

foreach ($result as $row) {

    $data[] = [
        // 'DT_RowID' => $row['ref_id'],
        // 'DT_RowData' => ['pkey' => $row['ref_id']],

        'ref_id' => $row['ref_id'],
        'student_id' => $row['student_id'],
        'slip_no' => $row['slip_no'],
        'method' => $row['method'],
        'department' => $row['assigned_department'],
        'due_date' => $row['compliance_due_date']

        // $row['ref_id'],
        // $row['student_id'],
        // $row['slip_no'],
        // $row['method'],
        // $row['assigned_department'],
        // $row['compliance_due_date']
    ];

}


$output = array(
    // 'filtered_row' => $filtered_row,
    "draw" => 1,
    "recordsTotal" => $filtered_row,
    "recordsFiltered" => $filtered_row,
    'data' => $data
);

// header("HTTP/1.0 200 goods");
// echo json_encode(['status' => 'Success', 'message' => 'Pick your poison', 'data' => $data]);

// echo json_encode($data);
// echo json_encode($output);

mysqli_close($conn);
