<?php


$sql = "SELECT intervention.ref_id, student.student_id, violation.slip_no, intervention.method, intervention.assigned_department, intervention.compliance_due_date, intervention.status
        FROM sql12729827.tbl_for_intervention as intervention
        INNER JOIN sql12729827.tbl_major_violation_records as violation
        ON intervention.slip_no = violation.slip_no
        INNER JOIN sql12729827.tbl_student_info as student
        ON student.student_id = violation.student_id
";




$result = mysqli_query($conn, $sql);
$data = array();


foreach ($result as $row) {

    $data[] = [
        'ref_id' => $row['ref_id'],
        'student_id' => $row['student_id'],
        'slip_no' => $row['slip_no'],
        'method' => $row['method'],
        'department' => $row['assigned_department'] ?? '--',
        'due_date' => $row['compliance_due_date'],
        'status' => $row['status']
    ];

}
// mysqli_close($conn);
