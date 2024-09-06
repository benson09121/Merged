<?php
session_start();
$_SESSION['currentpage'] = "violation";
$username = $_SESSION['username'];
include("../database/database_conn.php");
include('php/fetch_student_data.php');

$error_message = $_SESSION['error_message'] ?? null;
unset($_SESSION['error_message']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/DOMS_logo.png" type="image/x-icon">
    <title>Student Violation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/viob.css">
    <link rel="stylesheet" href="../css/student.css">
    <link rel="stylesheet" href="sidenav/sidenav.css">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <script src="js/screen_timeout.js"></script>



    <script>
        <?php if ($_SESSION['redirect_url']) : ?>
            console.log("Opening new tab");
            var newTab = window.open('<?php echo $_SESSION['redirect_url']; ?>', '_blank');
        <?php endif; ?>
    </script>

</head>

<body>

    <div class="sidenav">
        <?php
        include('sidenav/sidenav.php');
        ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const headerBtn = document.querySelector('.header-btn');
            const sidenavBtn = document.querySelector('.sidenav-btn');
            const sidenav = document.querySelector('.sidenav');

            headerBtn.addEventListener('click', () => {
                sidenav.classList.toggle('active');
            });

            sidenavBtn.addEventListener('click', () => {
                sidenav.classList.toggle('active');
            });
        });
    </script>

    <div class="header-btn">
        <i class="fas fa-bars"></i>
    </div>

    <section class="main-do">


        <div class="body-content">

                <div class="form-container">
                    <div class="student-violation">
                        <div class="student-header info-header">
                            <h1>Student Violation</h1>
                            <hr>
                        </div>

                        <?php
  echo '<button class="back-button-studvio" onclick="history.back()">> Back</button>';
?>
</div>
</div>  
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h5>Student Information</h5>
            <div class="mb-3 position-relative">
                <label for="student_id" class="form-label">Student ID</label>
                <div class="position-absolute top-0 end-0">
                    <button class="btn btn-primary me-2" id="search_student">View Profile</button>
                    <button class="btn btn-success" id="add_student">Add</button>
                </div>
                <input type="text" class="form-control-sm" id="student_id" style="padding-right: 160px;">
                <label for="student_name" class="form-label-sm">Student Name</label>
                <input type="text" class="form-control-sm" id="student_name" readonly>
                <label for="student_course" class="form-label-sm">Student Course</label>
                <input type="text" class="form-control-sm" id="student_course" readonly>
            </div>
   
        </div>
        <div class="col-md-6">
            <h5>Student List</h5>
            <div>
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Student ID</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Course</th>
                            <th scope="col">Action</th>
                        </tr>
                        <tr>
                            <th>27700</th>
                            <th>Red Bandoquillo</th>
                            <th>BSIT</th>
                            <th><button class="btn btn-primary">View</button></th>
                        </tr>
                        <tr>
                            <th>27700</th>
                            <th>Red Bandoquillo</th>
                            <th>BSIT</th>
                            <th><button class="btn btn-primary">View</button></th>
                        </tr>
                        <tr>
                            <th>27700</th>
                            <th>Red Bandoquillo</th>
                            <th>BSIT</th>
                            <th><button class="btn btn-primary">View</button></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
           <h5>Violation</h5>
           <div class="mb-3">
  <div class="row">
  <div class="col">
  <label for="BookTitle" class="form-label-sm">Offense Type</label>
    <input type="text" class="form-control-sm"></input>
  </div>
  <div class="col">
  <label for="BookTitle" class="form-label-sm">Violation Type</label>
    <input type="text" class="form-control-sm"></input>
  </div>
  <div class="col">
  <label for="BookTitle" class="form-label-sm">Category</label>
    <input type="text" class="form-control-sm"></input>
  </div>
</div>
  </div>
  <textarea class="form-control-sm" id="exampleFormControlTextarea1" rows="10" placeholder="Description"></textarea>
        </div>
        <div class="col">
        <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Student ID</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Course</th>
                            <th scope="col">Action</th>
                        </tr>
                            <th>27700</th>
                            <th>Red Bandoquillo</th>
                            <th>BSIT</th>
                            <th><button class="btn btn-primary">View</button></th>
                        </tr>
                    </thead>
                </table>
        </div>
    </div>
</div>


    <script src="../javascript/profile.js"></script>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</html>