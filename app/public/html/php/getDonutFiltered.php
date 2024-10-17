<?php
header('Content-type: application/json; charset=utf-8');

include '../../database/database_conn.php';

$from = $_POST['from'];
$to = $_POST['to'];
$id = $_POST['id'];

$labelMin = [];
$countMin = [];
$labelMaj = [];
$countMaj = [];

if ($from != '' && $to == '') {
    //from lang meron 
    if ($id == 0) {
        $sql1 = "SELECT des.short_desc as label, count(slip_no) as count
                FROM sql12729827.tbl_minor_violation_records as rec
                INNER JOIN sql12729827.tbl_minor_violations as des
                ON rec.violation_id = des.violation_id
                WHERE rec.date_of_apprehension >= '$from'
                GROUP BY short_desc;";
        $allMinResult = mysqli_query($conn, $sql1);
        // $minRows = mysqli_fetch_all($allMinResult, MYSQLI_ASSOC);

        $sql2 = "SELECT des.short_desc as label, count(slip_no) as count
                FROM sql12729827.tbl_major_violation_records as rec
                INNER JOIN sql12729827.tbl_major_violation as des
                ON rec.violation_id = des.violation_id
                WHERE rec.date_of_apprehension >= '$from'
                GROUP BY label;";
        $allMajResult = mysqli_query($conn, $sql2);
        // $majRows = mysqli_fetch_all($allMajResult, MYSQLI_ASSOC);


        foreach ($allMinResult as $rows) {
            $labelMin[] = $rows['label'];
            $countMin[] = $rows['count'];
        }

        foreach ($allMajResult as $rows) {
            $labelMaj[] = $rows['label'];
            $countMaj[] = $rows['count'];
        }


    } else {
        // spcific dept

        // minor
        $sql1 = "SELECT  des.short_desc as label, count(min.slip_no) as count
                FROM sql12729827.tbl_student_info as stu
                INNER JOIN sql12729827.tbl_course_info as cor
                ON stu.course_id = cor.course_id
                INNER JOIN sql12729827.tbl_department_info as dep
                ON dep.department_id = cor.department_id
                INNER JOIN sql12729827.tbl_minor_violation_records as min
                ON stu.student_id = min.student_id
                INNER JOIN sql12729827.tbl_minor_violations as des
                ON des.violation_id = min.violation_id
                WHERE dep.school_id = '$id' &&(min.date_of_apprehension >= '$from')
                GROUP BY label";

        $schoolMinResult = mysqli_query($conn, $sql1);
        // $minRows = mysqli_fetch_all($schoolMinResult, MYSQLI_ASSOC);

        //major
        $sql2 = "SELECT des.short_desc as label, count(min.slip_no) as count
                    FROM sql12729827.tbl_student_info as stu
                    INNER JOIN sql12729827.tbl_course_info as cor
                    ON stu.course_id = cor.course_id
                    INNER JOIN sql12729827.tbl_department_info as dep
                    ON dep.department_id = cor.department_id
                    INNER JOIN sql12729827.tbl_major_violation_records as min
                    ON stu.student_id = min.student_id
                    INNER JOIN sql12729827.tbl_major_violation as des
                    ON des.violation_id = min.violation_id
                    WHERE dep.school_id = '$id' &&(min.date_of_apprehension >= '$from')
                    GROUP BY label
                ";

        $schoolMajResult = mysqli_query($conn, $sql2);


        foreach ($schoolMinResult as $rows) {
            $labelMin[] = $rows['label'];
            $countMin[] = $rows['count'];
        }

        foreach ($schoolMajResult as $rows) {
            $labelMaj[] = $rows['label'];
            $countMaj[] = $rows['count'];
        }

    }


} elseif ($from == '' && $to != '') {
    //  to lang meron

    // echo 'to lang meron';

    if ($id == 0) {
        $sql1 = "SELECT des.short_desc as label, count(slip_no) as count
                FROM sql12729827.tbl_minor_violation_records as rec
                INNER JOIN sql12729827.tbl_minor_violations as des
                ON rec.violation_id = des.violation_id
                WHERE rec.date_of_apprehension <= '$to'
                GROUP BY short_desc;";
        $allMinResult = mysqli_query($conn, $sql1);
        // $minRows = mysqli_fetch_all($allMinResult, MYSQLI_ASSOC);

        $sql2 = "SELECT des.short_desc as label, count(slip_no) as count
                FROM sql12729827.tbl_major_violation_records as rec
                INNER JOIN sql12729827.tbl_major_violation as des
                ON rec.violation_id = des.violation_id
                WHERE rec.date_of_apprehension <= '$to'
                GROUP BY label;";
        $allMajResult = mysqli_query($conn, $sql2);
        // $majRows = mysqli_fetch_all($allMajResult, MYSQLI_ASSOC);


        foreach ($allMinResult as $rows) {
            $labelMin[] = $rows['label'];
            $countMin[] = $rows['count'];
        }

        foreach ($allMajResult as $rows) {
            $labelMaj[] = $rows['label'];
            $countMaj[] = $rows['count'];
        }


    } else {
        // spcific dept

        // minor
        $sql1 = "SELECT  des.short_desc as label, count(min.slip_no) as count
                FROM sql12729827.tbl_student_info as stu
                INNER JOIN sql12729827.tbl_course_info as cor
                ON stu.course_id = cor.course_id
                INNER JOIN sql12729827.tbl_department_info as dep
                ON dep.department_id = cor.department_id
                INNER JOIN sql12729827.tbl_minor_violation_records as min
                ON stu.student_id = min.student_id
                INNER JOIN sql12729827.tbl_minor_violations as des
                ON des.violation_id = min.violation_id
                WHERE dep.school_id = '$id' &&(min.date_of_apprehension <= '$to')
                GROUP BY label";

        $schoolMinResult = mysqli_query($conn, $sql1);
        // $minRows = mysqli_fetch_all($schoolMinResult, MYSQLI_ASSOC);

        //major
        $sql2 = "SELECT des.short_desc as label, count(min.slip_no) as count
                    FROM sql12729827.tbl_student_info as stu
                    INNER JOIN sql12729827.tbl_course_info as cor
                    ON stu.course_id = cor.course_id
                    INNER JOIN sql12729827.tbl_department_info as dep
                    ON dep.department_id = cor.department_id
                    INNER JOIN sql12729827.tbl_major_violation_records as min
                    ON stu.student_id = min.student_id
                    INNER JOIN sql12729827.tbl_major_violation as des
                    ON des.violation_id = min.violation_id
                    WHERE dep.school_id = '$id' &&(min.date_of_apprehension <= '$to')
                    GROUP BY label
                ";

        $schoolMajResult = mysqli_query($conn, $sql2);


        foreach ($schoolMinResult as $rows) {
            $labelMin[] = $rows['label'];
            $countMin[] = $rows['count'];
        }

        foreach ($schoolMajResult as $rows) {
            $labelMaj[] = $rows['label'];
            $countMaj[] = $rows['count'];
        }

    }

} else {
    // both

    // echo 'both';
    if ($id == 0) {
        $sql1 = "SELECT des.short_desc as label, count(slip_no) as count
                FROM sql12729827.tbl_minor_violation_records as rec
                INNER JOIN sql12729827.tbl_minor_violations as des
                ON rec.violation_id = des.violation_id
                WHERE rec.date_of_apprehension >= '$from' && rec.date_of_apprehension <= '$to'
                GROUP BY short_desc;";
        $allMinResult = mysqli_query($conn, $sql1);
        // $minRows = mysqli_fetch_all($allMinResult, MYSQLI_ASSOC);

        $sql2 = "SELECT des.short_desc as label, count(slip_no) as count
                FROM sql12729827.tbl_major_violation_records as rec
                INNER JOIN sql12729827.tbl_major_violation as des
                ON rec.violation_id = des.violation_id
                WHERE rec.date_of_apprehension >= '$from' && rec.date_of_apprehension <= '$to'
                GROUP BY label;";
        $allMajResult = mysqli_query($conn, $sql2);
        // $majRows = mysqli_fetch_all($allMajResult, MYSQLI_ASSOC);


        foreach ($allMinResult as $rows) {
            $labelMin[] = $rows['label'];
            $countMin[] = $rows['count'];
        }

        foreach ($allMajResult as $rows) {
            $labelMaj[] = $rows['label'];
            $countMaj[] = $rows['count'];
        }


    } else {
        // spcific dept

        // minor
        $sql1 = "SELECT  des.short_desc as label, count(min.slip_no) as count
                FROM sql12729827.tbl_student_info as stu
                INNER JOIN sql12729827.tbl_course_info as cor
                ON stu.course_id = cor.course_id
                INNER JOIN sql12729827.tbl_department_info as dep
                ON dep.department_id = cor.department_id
                INNER JOIN sql12729827.tbl_minor_violation_records as min
                ON stu.student_id = min.student_id
                INNER JOIN sql12729827.tbl_minor_violations as des
                ON des.violation_id = min.violation_id
                WHERE dep.school_id = '$id' &&(min.date_of_apprehension >= '$from' && rec.date_of_apprehension <= '$to')
                GROUP BY label";

        $schoolMinResult = mysqli_query($conn, $sql1);
        // $minRows = mysqli_fetch_all($schoolMinResult, MYSQLI_ASSOC);

        //major
        $sql2 = "SELECT des.short_desc as label, count(min.slip_no) as count
                    FROM sql12729827.tbl_student_info as stu
                    INNER JOIN sql12729827.tbl_course_info as cor
                    ON stu.course_id = cor.course_id
                    INNER JOIN sql12729827.tbl_department_info as dep
                    ON dep.department_id = cor.department_id
                    INNER JOIN sql12729827.tbl_major_violation_records as min
                    ON stu.student_id = min.student_id
                    INNER JOIN sql12729827.tbl_major_violation as des
                    ON des.violation_id = min.violation_id
                    WHERE dep.school_id = '$id' &&(min.date_of_apprehension >= '$from' && rec.date_of_apprehension <= '$to')
                    GROUP BY label
                ";

        $schoolMajResult = mysqli_query($conn, $sql2);


        foreach ($schoolMinResult as $rows) {
            $labelMin[] = $rows['label'];
            $countMin[] = $rows['count'];
        }

        foreach ($schoolMajResult as $rows) {
            $labelMaj[] = $rows['label'];
            $countMaj[] = $rows['count'];
        }

    }



}

$minor = ['label' => $labelMin, 'count' => $countMin];
$major = ['label' => $labelMaj, 'count' => $countMaj];


// $data = ['label' => $label, 'count' => $count];

echo json_encode(['minor' => $minor, 'major' => $major]);



mysqli_close($conn);
