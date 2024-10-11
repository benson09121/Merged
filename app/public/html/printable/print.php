<?php
session_start();

$data = isset($_GET['data']) ? json_decode(urldecode($_GET['data']), true) : [];


$student_id = $data['student_id'];
$name = $data['name'];
$section = $data['section'];
$course = $data['course'];
$violation_slip_number = $data['violation_slip'];

$violation = $_SESSION['violation'];
$category = $_SESSION['category'];
$type = $_SESSION['type'];

$formatted_violation_slip_number = str_pad($violation_slip_number, 4, '0', STR_PAD_LEFT);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../images/DOMS_logo.png" type="image/x-icon">
    <title>Violation Slip</title>
    <link rel="stylesheet" href="print.css">
</head>

<body>
    <div class="container">
        <h1>DISCIPLINE OFFICE</h1>
        <img src="../../images/DOMS_logo.png" alt="DOMS Logo">

        <div class="info">
            <div class="upper">
                <!-- how can I add 0000 on the violation slipa and I add something it would jsut be 0001 -->

                <h2>Violation Slip No. &nbsp;&nbsp;:&nbsp;&nbsp; <span><?php echo $formatted_violation_slip_number; ?></span></h2>
                <h3 id="currentDate"></h3>
            </div>
            <div class="mid">
                <div class="input-wrap">
                    <label for="student-id">Student ID:</label>
                    <input type="text" name="student-id" value="<?php echo $student_id ?>">
                </div>
                <div class="input-wrap">
                    <label for="name">Name:</label>
                    <input type="text" name="name" value="<?php echo $name ?>">
                </div>
                <div class="input-wrap">
                    <label for="course">Course:</label>
                    <input type="text" name="course" value="<?php echo $course ?>">
                </div>
                <div class="input-wrap">
                    <label for="section">Section:</label>
                    <input type="text" name="section" value="<?php echo $section ?>">
                </div>
                <div class="input-wrap">
                    <label for="violation">Violation Type:</label>
                    <input type="text" name="violation" value="<?php echo $violation ?>">
                </div>
                <div class="input-wrap">
                    <label for="offense">Offense Type:</label>
                    <input type="text" name="offense" value="<?php echo $type ?>">
                </div>
                <label for="description">Description:</label>
                <textarea name="description" id=""></textarea>
            </div>
            <div class="lower">
                <div class="lower-info">
                    <hr>
                    <h4>Discipline Office Personnel</h4>
                </div>
                <div class="lower-info">
                    <hr>
                    <h4>Student's Signature</h4>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    window.print();
</script>

</html>