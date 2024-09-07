<?php

    include '../database/database_conn.php';

    $studID = $_POST['studID'];
    $password = $_POST['password'];

    $sql = "SELECT tbl_stud.student_id, tbl_stud.f_name, tbl_stud.m_name, tbl_stud.l_name, tbl_sect.name as section, tbl_course.name as course ,tbl_course.description as courseName, tbl_school.school_name as school, tbl_stud.email, tbl_stud.gender, tbl_stud.account_status as acc_status
    FROM sql12729827.tbl_student_info as tbl_stud
    INNER JOIN sql12729827.tbl_section_info as tbl_sect
    ON tbl_stud.section_id = tbl_sect.section_id
    INNER JOIN sql12729827.tbl_course_info as tbl_course
    ON tbl_stud.course_id = tbl_course.course_id
    INNER JOIN sql12729827.tbl_department_info as tbl_dept
    ON tbl_course.department_id = tbl_dept.department_id
    INNER JOIN sql12729827.tbl_school_info as tbl_school
    ON tbl_dept.school_id = tbl_school.school_id
    WHERE tbl_stud.student_id = '". $studID ."' && tbl_stud.password = '". $password ."'";

    $result = mysqli_query($conn, $sql);
    $final_data = [];
    if (mysqli_num_rows($result) >= 1) {

        
        $index=0;
        
 
        while($row = mysqli_fetch_assoc($result)) {

            $data = [ 'studID' => $row["student_id"], 
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


            $final_data[$index] = $data;
            $index ++ ;
        }        
    } 
    header('Content-type: application/json; charset=utf-8');
    echo '{"results": '. json_encode( $final_data )."}";


    mysqli_close($conn);
?>