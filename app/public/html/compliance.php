<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['role']) && !isset($_SESSION['employee_id'])) {
    header("Location: login-page.php");
} else {
    $_SESSION['currentpage'] = "compliance";
    include '../database/database_conn.php';
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../images/DOMS_logo.png" type="image/x-icon">
        <title>Compliance</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
            integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../css/home.css">
        <link rel="stylesheet" href="sidenav/sidenav.css">
        <link rel="stylesheet" href="../css/general.css">

        <link href="https://cdn.datatables.net/v/dt/dt-2.1.8/datatables.min.css" rel="stylesheet">

        <script src="js/screen_timeout.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="https://cdn.datatables.net/v/dt/dt-2.1.8/datatables.min.js"></script>

    </head>

    <body>

        <div class="sidenav">
            <?php
            include('sidenav/sidenav.php');
            ?>
        </div>
        <!-- Nav -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
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

                <div class="title-page">
                    <h1>Student Intervention</h1>
                    <hr>
                </div>

                <div class="ms-3 table-responsive">
                    <table id="dt_intervention" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-start">INTERVENTION NO.</th>
                                <th class="text-start">STUDENT ID</th>
                                <th class="text-start">SLIP NO.</th>
                                <th class="text-start">INTERVENTION METHOD</th>
                                <th class="text-start">ASSIGNED DEPARTMENT</th>
                                <th class="text-start">COMPLIANCE DUE DATE</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            include('php/getIntervention.php');

                            foreach ($data as $row) {

                                echo "<tr>
                            <td class='text-start'>{$row['ref_id']}</td>
                            <td class='text-start'>{$row['student_id']}</td>
                            <td class='text-start'>{$row['slip_no']}</td>
                            <td class='text-start'>{$row['method']}</td>
                            <td class='text-start'>{$row['department']}</td>
                            <td class='text-start'>{$row['due_date']}</td>
                            </tr>";
                            }

                            ?>

                        </tbody>
                    </table>
                </div>


            </div>

        </section>

    </body>

    <script>

        $(document).ready(function () {

            $('#dt_intervention').DataTable({
            });

        })


    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>


    </html>
    <?php
}



?>