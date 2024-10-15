<?php
session_start();
include '../../database/database_conn.php';
$id = $_POST['id'];



if ($id == 0) {
    $sql = "SELECT sch.school_id, sch.school_name, sch.description, count(rec.slip_no) as majCount, count(min.slip_no) as minCount
            FROM sql12729827.tbl_school_info as sch
            LEFT JOIN sql12729827.tbl_department_info as dep
            ON sch.school_id = dep.school_id
            LEFT JOIN sql12729827.tbl_course_info as cor
            ON cor.department_id = dep.department_id
            LEFT JOIN sql12729827.tbl_student_info as stu
            ON stu.course_id = cor.course_id
            LEFT JOIN sql12729827.tbl_major_violation_records as rec
            ON stu.student_id = rec.student_id
            LEFT JOIN sql12729827.tbl_minor_violation_records as min
            ON stu.student_id = min.student_id
            GROUP BY school_id";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($rows);
} else {
    $sql = "SELECT dep.department_id, dep.school_id, dep.name, dep.description, count(maj.slip_no) as majCount, count(min.slip_no) as minCount
            FROM sql12729827.tbl_department_info as dep
            LEFT JOIN sql12729827.tbl_course_info as cor
            ON cor.department_id = dep.department_id
            LEFT JOIN sql12729827.tbl_student_info as stu
            ON cor.course_id = stu.course_id
            LEFT JOIN sql12729827.tbl_major_violation_records as maj
            ON stu.student_id = maj.student_id
            LEFT JOIN sql12729827.tbl_minor_violation_records as min
            ON stu.student_id = min.student_id
            WHERE school_id='$id'
            GROUP BY department_id";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($rows);
}
$conn->close();
?>