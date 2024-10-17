<?php
session_start();
include '../../database/database_conn.php';
$id = $_POST['id'];
$from = $_POST['from'];
$to = $_POST['to'];


if ($from == '' && $to == '') {
    // no date filtering
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
} else {
    // may date filtering
    if ($from != '' && $to == '') {
        // from lang yung date
        if ($id == 0) {
            // per school
            $sql1 = "SELECT * FROM sql12729827.tbl_school_info;";
            $schoolResult = mysqli_query($conn, $sql1);

            $sql2 = "SELECT  sch.school_id, count(min.slip_no) as minCount
                        FROM sql12729827.tbl_student_info as stu
                        INNER JOIN sql12729827.tbl_course_info as cor
                        ON cor.course_id = stu.course_id
                        INNER JOIN sql12729827.tbl_department_info as dep
                        ON cor.department_id = dep.department_id
                        INNER JOIN sql12729827.tbl_school_info as sch
                        ON dep.school_id = sch.school_id
                        INNER JOIN sql12729827.tbl_minor_violation_records as min
                        ON min.student_id = stu.student_id
                        WHERE min.date_of_apprehension >= '$from'
                        GROUP BY dep.school_id";
            $minResult = mysqli_query($conn, $sql2);

            $sql3 = "SELECT  sch.school_id, count(min.slip_no) as minCount
                        FROM sql12729827.tbl_student_info as stu
                        INNER JOIN sql12729827.tbl_course_info as cor
                        ON cor.course_id = stu.course_id
                        INNER JOIN sql12729827.tbl_department_info as dep
                        ON cor.department_id = dep.department_id
                        INNER JOIN sql12729827.tbl_school_info as sch
                        ON dep.school_id = sch.school_id
                        INNER JOIN sql12729827.tbl_major_violation_records as min
                        ON min.student_id = stu.student_id
                        WHERE min.date_of_apprehension >= '$from'
                        GROUP BY dep.school_id";
            $majResult = mysqli_query($conn, $sql3);

            $data = [];

            foreach ($schoolResult as $rows) {

                $minCount = 0;
                $majCount = 0;

                foreach ($minResult as $minRows) {
                    if ($minRows['school_id'] == $rows['school_id']) {
                        $minCount = $minRows['minCount'];
                    }
                }
                foreach ($majResult as $majRows) {
                    if ($majRows['school_id'] == $rows['school_id']) {
                        $majCount = $majRows['minCount'];
                    }
                }

                $data[] = [
                    'school_id' => $rows['school_id'],
                    'school_name' => $rows['school_name'],
                    'description' => $rows['description'],
                    'minCount' => $minCount,
                    'majCount' => $majCount,
                ];
            }

            echo json_encode($data);
        } else {
            //per course
            $sql1 = "SELECT * 
                    FROM sql12729827.tbl_department_info
                    WHERE school_id = '$id'";
            $courseResult = mysqli_query($conn, $sql1);

            //min
            $sql2 = "SELECT cor.department_id, count(min.slip_no) as minCount
                    FROM sql12729827.tbl_student_info as stu
                    INNER JOIN sql12729827.tbl_course_info as cor
                    ON cor.course_id = stu.course_id
                    INNER JOIN sql12729827.tbl_department_info as dep
                    ON cor.department_id = dep.department_id
                    INNER JOIN sql12729827.tbl_minor_violation_records as min
                    ON stu.student_id = min.student_id
                    WHERE dep.school_id = '$id' && min.date_of_apprehension >= '$from'
                    GROUP BY school_id";
            $minResult = mysqli_query($conn, $sql2);

            //maj
            $sql3 = "SELECT cor.department_id, count(min.slip_no) as minCount
                    FROM sql12729827.tbl_student_info as stu
                    INNER JOIN sql12729827.tbl_course_info as cor
                    ON cor.course_id = stu.course_id
                    INNER JOIN sql12729827.tbl_department_info as dep
                    ON cor.department_id = dep.department_id
                    INNER JOIN sql12729827.tbl_major_violation_records as min
                    ON stu.student_id = min.student_id
                    WHERE dep.school_id = '$id' && min.date_of_apprehension >= '$from'
                    GROUP BY school_id";
            $majResult = mysqli_query($conn, $sql3);





            $data = [];

            foreach ($courseResult as $rowsCourse) {

                $minCount = 0;

                foreach ($minResult as $minRows) {
                    if ($minRows['department_id'] == $rowsCourse['department_id']) {
                        $minCount = $minRows['minCount'];
                    }
                }

                $majCount = 0;

                foreach ($majResult as $majRows) {
                    if ($majRows['department_id'] == $rowsCourse['department_id']) {
                        $majCount = $majRows['minCount'];
                    }
                }


                $data[] = [

                    'department_id' => $rowsCourse['department_id'],
                    'school_id' => $rowsCourse['school_id'],
                    'name' => $rowsCourse['name'],
                    'description' => $rowsCourse['description'],
                    'majCount' => $majCount,
                    'minCount' => $minCount,

                ];

            }


            echo json_encode($data);
        }

    } elseif ($from == '' && $to != '') {
        // to lang yung date
        if ($id == 0) {
            // per school
            $sql1 = "SELECT * FROM sql12729827.tbl_school_info;";
            $schoolResult = mysqli_query($conn, $sql1);

            $sql2 = "SELECT  sch.school_id, count(min.slip_no) as minCount
                        FROM sql12729827.tbl_student_info as stu
                        INNER JOIN sql12729827.tbl_course_info as cor
                        ON cor.course_id = stu.course_id
                        INNER JOIN sql12729827.tbl_department_info as dep
                        ON cor.department_id = dep.department_id
                        INNER JOIN sql12729827.tbl_school_info as sch
                        ON dep.school_id = sch.school_id
                        INNER JOIN sql12729827.tbl_minor_violation_records as min
                        ON min.student_id = stu.student_id
                        WHERE min.date_of_apprehension <= '$to'
                        GROUP BY dep.school_id";
            $minResult = mysqli_query($conn, $sql2);

            $sql3 = "SELECT  sch.school_id, count(min.slip_no) as minCount
                        FROM sql12729827.tbl_student_info as stu
                        INNER JOIN sql12729827.tbl_course_info as cor
                        ON cor.course_id = stu.course_id
                        INNER JOIN sql12729827.tbl_department_info as dep
                        ON cor.department_id = dep.department_id
                        INNER JOIN sql12729827.tbl_school_info as sch
                        ON dep.school_id = sch.school_id
                        INNER JOIN sql12729827.tbl_major_violation_records as min
                        ON min.student_id = stu.student_id
                        WHERE min.date_of_apprehension <= '$to'
                        GROUP BY dep.school_id";
            $majResult = mysqli_query($conn, $sql3);

            $data = [];

            foreach ($schoolResult as $rows) {

                $minCount = 0;
                $majCount = 0;

                foreach ($minResult as $minRows) {
                    if ($minRows['school_id'] == $rows['school_id']) {
                        $minCount = $minRows['minCount'];
                    }
                }
                foreach ($majResult as $majRows) {
                    if ($majRows['school_id'] == $rows['school_id']) {
                        $majCount = $majRows['minCount'];
                    }
                }

                $data[] = [
                    'school_id' => $rows['school_id'],
                    'school_name' => $rows['school_name'],
                    'description' => $rows['description'],
                    'minCount' => $minCount,
                    'majCount' => $majCount,
                ];
            }

            echo json_encode($data);
        } else {
            //per course
            $sql1 = "SELECT * 
                    FROM sql12729827.tbl_department_info
                    WHERE school_id = '$id'";
            $courseResult = mysqli_query($conn, $sql1);

            //min
            $sql2 = "SELECT cor.department_id, count(min.slip_no) as minCount
                    FROM sql12729827.tbl_student_info as stu
                    INNER JOIN sql12729827.tbl_course_info as cor
                    ON cor.course_id = stu.course_id
                    INNER JOIN sql12729827.tbl_department_info as dep
                    ON cor.department_id = dep.department_id
                    INNER JOIN sql12729827.tbl_minor_violation_records as min
                    ON stu.student_id = min.student_id
                    WHERE dep.school_id = '$id' && min.date_of_apprehension <= '$to'
                    GROUP BY school_id";
            $minResult = mysqli_query($conn, $sql2);

            //maj
            $sql3 = "SELECT cor.department_id, count(min.slip_no) as minCount
                    FROM sql12729827.tbl_student_info as stu
                    INNER JOIN sql12729827.tbl_course_info as cor
                    ON cor.course_id = stu.course_id
                    INNER JOIN sql12729827.tbl_department_info as dep
                    ON cor.department_id = dep.department_id
                    INNER JOIN sql12729827.tbl_major_violation_records as min
                    ON stu.student_id = min.student_id
                    WHERE dep.school_id = '$id' && min.date_of_apprehension <= '$to'
                    GROUP BY school_id";
            $majResult = mysqli_query($conn, $sql3);





            $data = [];

            foreach ($courseResult as $rowsCourse) {

                $minCount = 0;

                foreach ($minResult as $minRows) {
                    if ($minRows['department_id'] == $rowsCourse['department_id']) {
                        $minCount = $minRows['minCount'];
                    }
                }

                $majCount = 0;

                foreach ($majResult as $majRows) {
                    if ($majRows['department_id'] == $rowsCourse['department_id']) {
                        $majCount = $majRows['minCount'];
                    }
                }


                $data[] = [

                    'department_id' => $rowsCourse['department_id'],
                    'school_id' => $rowsCourse['school_id'],
                    'name' => $rowsCourse['name'],
                    'description' => $rowsCourse['description'],
                    'majCount' => $majCount,
                    'minCount' => $minCount,

                ];

            }


            echo json_encode($data);
        }






    } else {
        //both mrong date
        if ($id == 0) {
            // per school
            $sql1 = "SELECT * FROM sql12729827.tbl_school_info;";
            $schoolResult = mysqli_query($conn, $sql1);

            $sql2 = "SELECT  sch.school_id, count(min.slip_no) as minCount
                        FROM sql12729827.tbl_student_info as stu
                        INNER JOIN sql12729827.tbl_course_info as cor
                        ON cor.course_id = stu.course_id
                        INNER JOIN sql12729827.tbl_department_info as dep
                        ON cor.department_id = dep.department_id
                        INNER JOIN sql12729827.tbl_school_info as sch
                        ON dep.school_id = sch.school_id
                        INNER JOIN sql12729827.tbl_minor_violation_records as min
                        ON min.student_id = stu.student_id
                        WHERE min.date_of_apprehension >= '$from' && min.date_of_apprehension <= '$to'
                        GROUP BY dep.school_id";
            $minResult = mysqli_query($conn, $sql2);

            $sql3 = "SELECT  sch.school_id, count(min.slip_no) as minCount
                        FROM sql12729827.tbl_student_info as stu
                        INNER JOIN sql12729827.tbl_course_info as cor
                        ON cor.course_id = stu.course_id
                        INNER JOIN sql12729827.tbl_department_info as dep
                        ON cor.department_id = dep.department_id
                        INNER JOIN sql12729827.tbl_school_info as sch
                        ON dep.school_id = sch.school_id
                        INNER JOIN sql12729827.tbl_major_violation_records as min
                        ON min.student_id = stu.student_id
                        WHERE min.date_of_apprehension >= '$from' && min.date_of_apprehension <= '$to'
                        GROUP BY dep.school_id";
            $majResult = mysqli_query($conn, $sql3);

            $data = [];

            foreach ($schoolResult as $rows) {

                $minCount = 0;
                $majCount = 0;

                foreach ($minResult as $minRows) {
                    if ($minRows['school_id'] == $rows['school_id']) {
                        $minCount = $minRows['minCount'];
                    }
                }
                foreach ($majResult as $majRows) {
                    if ($majRows['school_id'] == $rows['school_id']) {
                        $majCount = $majRows['minCount'];
                    }
                }

                $data[] = [
                    'school_id' => $rows['school_id'],
                    'school_name' => $rows['school_name'],
                    'description' => $rows['description'],
                    'minCount' => $minCount,
                    'majCount' => $majCount,
                ];
            }

            echo json_encode($data);
        } else {
            //per course
            $sql1 = "SELECT * 
                    FROM sql12729827.tbl_department_info
                    WHERE school_id = '$id'";
            $courseResult = mysqli_query($conn, $sql1);

            //min
            $sql2 = "SELECT cor.department_id, count(min.slip_no) as minCount
                    FROM sql12729827.tbl_student_info as stu
                    INNER JOIN sql12729827.tbl_course_info as cor
                    ON cor.course_id = stu.course_id
                    INNER JOIN sql12729827.tbl_department_info as dep
                    ON cor.department_id = dep.department_id
                    INNER JOIN sql12729827.tbl_minor_violation_records as min
                    ON stu.student_id = min.student_id
                    WHERE dep.school_id = '$id' && (min.date_of_apprehension >= '$from' && min.date_of_apprehension <= '$to')
                    GROUP BY school_id";
            $minResult = mysqli_query($conn, $sql2);

            //maj
            $sql3 = "SELECT cor.department_id, count(min.slip_no) as minCount
                    FROM sql12729827.tbl_student_info as stu
                    INNER JOIN sql12729827.tbl_course_info as cor
                    ON cor.course_id = stu.course_id
                    INNER JOIN sql12729827.tbl_department_info as dep
                    ON cor.department_id = dep.department_id
                    INNER JOIN sql12729827.tbl_major_violation_records as min
                    ON stu.student_id = min.student_id
                    WHERE dep.school_id = '$id' && (min.date_of_apprehension >= '$from' && min.date_of_apprehension <= '$to')
                    GROUP BY school_id";
            $majResult = mysqli_query($conn, $sql3);





            $data = [];

            foreach ($courseResult as $rowsCourse) {

                $minCount = 0;

                foreach ($minResult as $minRows) {
                    if ($minRows['department_id'] == $rowsCourse['department_id']) {
                        $minCount = $minRows['minCount'];
                    }
                }

                $majCount = 0;

                foreach ($majResult as $majRows) {
                    if ($majRows['department_id'] == $rowsCourse['department_id']) {
                        $majCount = $majRows['minCount'];
                    }
                }


                $data[] = [

                    'department_id' => $rowsCourse['department_id'],
                    'school_id' => $rowsCourse['school_id'],
                    'name' => $rowsCourse['name'],
                    'description' => $rowsCourse['description'],
                    'majCount' => $majCount,
                    'minCount' => $minCount,

                ];

            }


            echo json_encode($data);
        }


    }
}






$conn->close();
?>