<?php
header('Content-type: application/json; charset=utf-8');
include '../database/database_conn.php';

$studID = trim($_POST['studID']);
$password = trim($_POST['password']);

$sql = "SELECT tbl_stud.student_id, tbl_stud.f_name, tbl_stud.m_name, tbl_stud.l_name, tbl_stud.password, tbl_sect.name as section, tbl_course.name as course ,tbl_course.description as courseName, tbl_school.school_name as school, tbl_stud.email, tbl_stud.gender, tbl_stud.account_status as acc_status
    FROM sql12729827.tbl_student_info as tbl_stud
    INNER JOIN sql12729827.tbl_section_info as tbl_sect
    ON tbl_stud.section_id = tbl_sect.section_id
    INNER JOIN sql12729827.tbl_course_info as tbl_course
    ON tbl_stud.course_id = tbl_course.course_id
    INNER JOIN sql12729827.tbl_department_info as tbl_dept
    ON tbl_course.department_id = tbl_dept.department_id
    INNER JOIN sql12729827.tbl_school_info as tbl_school
    ON tbl_dept.school_id = tbl_school.school_id
    WHERE tbl_stud.student_id = '$studID'";

$result = mysqli_query($conn, $sql);
$final_data = [];
if (mysqli_num_rows($result) >= 1) {

    $row = mysqli_fetch_assoc($result);

    $hashedPass = $row['password'] ?? '';

    if ($hashedPass) {
        if (password_verify($password, $hashedPass)) {
            $final_data = [
                'studID' => $row["student_id"],
                'f_name' => $row["f_name"],
                'm_name' => $row["m_name"],
                'l_name' => $row["l_name"],
                'section' => $row["section"],
                'course' => $row["course"],
                'courseName' => $row["courseName"],
                'school' => $row["school"],
                'email' => $row["email"],
                'gender' => $row["gender"],
                'acc_status' => $row["acc_status"],
            ];
            header("HTTP/1.0 200 marvelous");
            echo json_encode(['status' => 'Success', 'message' => 'Logged in Successfully', 'userData' => $final_data]);
        } else {
            header("HTTP/1.0 200 ok");
            echo json_encode(['status' => 'Fail', 'message' => 'Wrong credentials']);
        }
    } else {
        header("HTTP/1.0 200 ok");
        echo json_encode(['status' => 'Fail', 'message' => 'Unregistered account']);
    }

} else {
    header("HTTP/1.0 200 ok");
    echo json_encode(['status' => 'Fail', 'message' => 'No user found']);
}





mysqli_close($conn);
