<?php
header('Content-type: application/json; charset=utf-8');

include '../../database/database_conn.php';


// all minor
$sqlAll = "SELECT des.short_desc as label, count(slip_no) as count
FROM sql12729827.tbl_minor_violation_records as rec
INNER JOIN sql12729827.tbl_minor_violations as des
ON rec.violation_id = des.violation_id
GROUP BY short_desc";

$resAll = mysqli_query($conn, $sqlAll);
$allLabel = $allCount = [];
foreach ($resAll as $row) {

    $allLabel[] = $row['label'];
    $allCount[] = $row['count'];

}
$dataAll = ['label' => $allLabel, 'count' => $allCount];

// seca (3) minor
$sqlSeca = "SELECT des.short_desc as label, count(slip_no) as count
            FROM sql12729827.tbl_minor_violation_records as rec
            INNER JOIN sql12729827.tbl_minor_violations as des
            ON rec.violation_id = des.violation_id
            INNER JOIN sql12729827.tbl_student_info as stud
            ON rec.student_id = stud.student_id
            INNER JOIN sql12729827.tbl_course_info as cors
            ON stud.course_id = cors.course_id
            INNER JOIN sql12729827.tbl_department_info as dept
            ON cors.department_id = dept.department_id
            WHERE school_id = 3 
            GROUP BY short_desc";

$resSeca = mysqli_query($conn, $sqlSeca);
$secaLabel = $secaCount = [];
foreach ($resSeca as $row) {

    $secaLabel[] = $row['label'];
    $secaCount[] = $row['count'];

}
$dataSeca = ['label' => $secaLabel, 'count' => $secaCount];


// sbma (2) minor
$sqlSbma = "SELECT des.short_desc as label, count(slip_no) as count
            FROM sql12729827.tbl_minor_violation_records as rec
            INNER JOIN sql12729827.tbl_minor_violations as des
            ON rec.violation_id = des.violation_id
            INNER JOIN sql12729827.tbl_student_info as stud
            ON rec.student_id = stud.student_id
            INNER JOIN sql12729827.tbl_course_info as cors
            ON stud.course_id = cors.course_id
            INNER JOIN sql12729827.tbl_department_info as dept
            ON cors.department_id = dept.department_id
            WHERE school_id = 2
            GROUP BY short_desc";

$resSbma = mysqli_query($conn, $sqlSbma);
$sbmaLabel = $sbmaCount = [];
foreach ($resSbma as $row) {

    $sbmaLabel[] = $row['label'];
    $sbmaCount[] = $row['count'];

}
$dataSbma = ['label' => $sbmaLabel, 'count' => $sbmaCount];


// sase (1) minor
$sqlSase = "SELECT des.short_desc as label, count(slip_no) as count
            FROM sql12729827.tbl_minor_violation_records as rec
            INNER JOIN sql12729827.tbl_minor_violations as des
            ON rec.violation_id = des.violation_id
            INNER JOIN sql12729827.tbl_student_info as stud
            ON rec.student_id = stud.student_id
            INNER JOIN sql12729827.tbl_course_info as cors
            ON stud.course_id = cors.course_id
            INNER JOIN sql12729827.tbl_department_info as dept
            ON cors.department_id = dept.department_id
            WHERE school_id = 1 
            GROUP BY short_desc";

$resSase = mysqli_query($conn, $sqlSase);
$saseLabel = $saseCount = [];
foreach ($resSase as $row) {

    $saseLabel[] = $row['label'];
    $saseCount[] = $row['count'];

}
$dataSase = ['label' => $saseLabel, 'count' => $saseCount];

// all major
$sqlAllMajor = "SELECT des.short_desc as label, count(slip_no) as count
                FROM sql12729827.tbl_major_violation_records as rec
                INNER JOIN sql12729827.tbl_major_violation as des
                ON rec.violation_id = des.violation_id
                GROUP BY label";

$resAllMajor = mysqli_query($conn, $sqlAllMajor);
$allLabelMajor = $allCountMajor = [];
foreach ($resAllMajor as $row) {

    $allLabelMajor[] = $row['label'];
    $allCountMajor[] = $row['count'];

}
$dataAllMajor = ['label' => $allLabelMajor, 'count' => $allCountMajor];

// sase (1) major
$sqlSaseMajor = "SELECT des.short_desc as label, count(slip_no) as count
                    FROM sql12729827.tbl_major_violation_records as rec
                    INNER JOIN sql12729827.tbl_major_violation as des
                    ON rec.violation_id = des.violation_id
                    INNER JOIN sql12729827.tbl_student_info as stu
                    ON rec.student_id = stu.student_id
                    INNER JOIN sql12729827.tbl_course_info as cor
                    ON stu.course_id = cor.course_id
                    INNER JOIN sql12729827.tbl_department_info as dep
                    ON cor.department_id = dep.department_id
                    WHERE school_id = 1
                    GROUP BY label";

$resSaseMajor = mysqli_query($conn, $sqlSaseMajor);
$saseLabelMajor = $saseCountMajor = [];
foreach ($resSaseMajor as $row) {

    $saseLabelMajor[] = $row['label'];
    $saseCountMajor[] = $row['count'];

}
$dataSaseMajor = ['label' => $saseLabelMajor, 'count' => $saseCountMajor];

// sbma (2) major
$sqlSbmaMajor = "SELECT des.short_desc as label, count(slip_no) as count
                    FROM sql12729827.tbl_major_violation_records as rec
                    INNER JOIN sql12729827.tbl_major_violation as des
                    ON rec.violation_id = des.violation_id
                    INNER JOIN sql12729827.tbl_student_info as stu
                    ON rec.student_id = stu.student_id
                    INNER JOIN sql12729827.tbl_course_info as cor
                    ON stu.course_id = cor.course_id
                    INNER JOIN sql12729827.tbl_department_info as dep
                    ON cor.department_id = dep.department_id
                    WHERE school_id = 2
                    GROUP BY label";

$resSbmaMajor = mysqli_query($conn, $sqlSbmaMajor);
$sbmaLabelMajor = $sbmaCountMajor = [];
foreach ($resSbma as $row) {

    $sbmaLabelMajor[] = $row['label'];
    $sbmaCountMajor[] = $row['count'];

}
$dataSbmaMajor = ['label' => $sbmaLabelMajor, 'count' => $sbmaCountMajor];

// seca (3) Major
$sqlSecaMajor = "SELECT des.short_desc as label, count(slip_no) as count
                    FROM sql12729827.tbl_major_violation_records as rec
                    INNER JOIN sql12729827.tbl_major_violation as des
                    ON rec.violation_id = des.violation_id
                    INNER JOIN sql12729827.tbl_student_info as stu
                    ON rec.student_id = stu.student_id
                    INNER JOIN sql12729827.tbl_course_info as cor
                    ON stu.course_id = cor.course_id
                    INNER JOIN sql12729827.tbl_department_info as dep
                    ON cor.department_id = dep.department_id
                    WHERE school_id = 3
                    GROUP BY label";

$resSecaMajor = mysqli_query($conn, $sqlSecaMajor);
$secaLabelMajor = $secaCountMajor = [];
foreach ($resSecaMajor as $row) {

    $secaLabelMajor[] = $row['label'];
    $secaCountMajor[] = $row['count'];

}
$dataSecaMajor = ['label' => $secaLabelMajor, 'count' => $secaCountMajor];







$minor = ['all' => $dataAll, 'seca' => $dataSeca, 'sbma' => $dataSbma, 'sase' => $dataSase];
$major = ['all' => $dataAllMajor, 'seca' => $dataSecaMajor, 'sbma' => $dataSbmaMajor, 'sase' => $dataSaseMajor];


header('HTTP/1.1 200 donutGood');
echo json_encode(['status' => 'ok', 'minor' => $minor, 'major' => $major]);



mysqli_close($conn);
