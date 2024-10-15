<?php


$sql = 'SELECT sch.school_id, sch.school_name, sch.description, count(rec.slip_no) as majCount, count(min.slip_no) as minCount
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
            GROUP BY school_id;';

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        ?>
        <div class="dept dept1">
            <div class="card">
                <div class="card-header"><?php echo $row['majCount'] + $row['minCount']; ?></div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['school_name']; ?></h5>
                    <p class="card-text"><?php echo $row['description']; ?></p>
                </div>
            </div>
        </div>

        <?php
    }
} else {
    echo 'No Data Found.';
}
$conn->close();
?>