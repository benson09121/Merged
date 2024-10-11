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
        <link rel="stylesheet" href="../css/studentCompliance.css">

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
                    <!-- <button onclick="history.go(-1);"><i class="fa-solid fa-left-long"></i></button> -->

                    <h1><i class="fa-solid fa-chevron-left fa-sm me-3 btn_back" onclick="history.go(-1);"
                            style="color: #1b4284;"></i>Student
                        Compliance</h1>
                    <hr>
                </div>

                <!-- navigation -->
                <nav class="mx-3 navigation">
                    <div class="nav nav-tabs d-flex justify-content-around" id="nav-tab" role="tablist">
                        <button class="nav-link position-relative active " id="nav-intervention-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-intervention" type="button" role="tab" aria-controls="nav-intervention"
                            aria-selected="true">INTERVENTION<span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill text-bg-secondary">
                                <?php
                                include('php/getIntervention.php');

                                echo count($data);

                                ?>

                            </span></button>
                        <button class="nav-link position-relative" id="nav-conference-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-conference" type="button" role="tab" aria-controls="nav-conference"
                            aria-selected="false">CONFERENCE<span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill text-bg-secondary">
                                <?php
                                include 'php/getConference.php';

                                echo count($dataConference);

                                ?>

                            </span></button>
                    </div>
                </nav>
                <!-- tabs -->
                <div class="tab-content mt-5" id="nav-tabContent">
                    <!-- intervention tab -->
                    <div class="tab-pane fade show active" id="nav-intervention" role="tabpanel"
                        aria-labelledby="nav-intervention-tab" tabindex="0">
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
                                    // include('php/getIntervention.php');
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
                    <!-- conference tab -->
                    <div class="tab-pane fade" id="nav-conference" role="tabpanel" aria-labelledby="nav-conference-tab"
                        tabindex="0">
                        <div class="ms-3 table-responsive">
                            <table id="dt_conference" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-start">CONFERENCE NO.</th>
                                        <th class="text-start">STUDENT ID</th>
                                        <th class="text-start">SLIP NO.</th>
                                        <th class="text-start">CONFERENCE TYPE</th>
                                        <th class="text-start">ATENDEES</th>
                                        <th class="text-start">SCHEDULED DATE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($dataConference as $row) {
                                        $attendees = '';
                                        foreach ($dataAttendees as $rowA) {
                                            if ($row['ref_id'] == $rowA['conf_no']) {
                                                $attendees = $attendees . $rowA['name'] . '<br/>';
                                            }
                                        }
                                        echo "<tr>
                                            <td class='text-start'>{$row['ref_id']}</td>
                                            <td class='text-start'>{$row['student_id']}</td>
                                            <td class='text-start'>{$row['slip_no']}</td>
                                            <td class='text-start'>{$row['conference_type']}</td>
                                            <td class='text-start'>$attendees</td>
                                            <td class='text-start'>{$row['scheduled_date']}</td>
                                            </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </section>

    </body>

    <script>

        $(document).ready(function () {

            // intervention datatable initialization
            var oTable = $('#dt_intervention').DataTable({
                layout: {
                    topStart: 'search',
                    topEnd: $(' <div class="dt-filter-date"><label for="dt-date-from">from: </label><input type="date" class="dt-input mx-2 align-middle" id="dt-date-from" placeholder="" aria-controls="dt_intervention"><label for="dt-date-to">to:</label><input type="date" class="dt-input mx-2 align-middle" id="dt-date-to" placeholder="" aria-controls="dt_intervention"><button type="button" class="btn btn-danger" id="btn_clear_filter">clear filter</button></div>'),
                    bottomStart: 'pageLength',
                    bottom2End: 'info',
                }
            });

            // clear date filter intervention
            $('#btn_clear_filter').on('click', function () {

                if ($('#dt-date-to').val() || $('#dt-date-from').val()) {
                    $('#dt-date-to').val('');
                    $('#dt-date-from').val('');
                    minDateFilter = "";
                    maxDateFilter = "";
                    oTable.draw();
                }



            });

            // get input dates
            $(function () {

                // get max date (to)
                $("#dt-date-to").on("change", function () {

                    let date_to = $('#dt-date-to').val();

                    maxDateFilter = new Date(date_to).getTime();
                    oTable.draw();

                });

                // get min date (from)
                $("#dt-date-from").on("change", function () {

                    let date_from = $('#dt-date-from').val();

                    minDateFilter = new Date(date_from).getTime();
                    oTable.draw();

                });


            });

            // Date range filter intervention
            minDateFilter = "";
            maxDateFilter = "";

            // date filter funtion intervention
            $.fn.dataTableExt.afnFiltering.push(
                function (oSettings, aData, iDataIndex) {
                    if (typeof aData._date == 'undefined') {
                        aData._date = new Date(aData[5]).getTime();
                    }

                    if (minDateFilter && !isNaN(minDateFilter)) {
                        if (aData._date < minDateFilter) {
                            return false;
                        }
                    }

                    if (maxDateFilter && !isNaN(maxDateFilter)) {
                        if (aData._date > maxDateFilter) {
                            return false;
                        }
                    }

                    return true;
                }
            );

            // conference datatable intitialization
            var aTable = $('#dt_conference').DataTable({
                layout: {
                    topStart: 'search',
                    topEnd: $(' <div class="dt-filter-date-c"><label for="dt-date-from-c">from: </label><input type="date" class="dt-input mx-2 align-middle" id="dt-date-from-c" placeholder="" aria-controls="dt_conference"><label for="dt-date-to-c">to:</label><input type="date" class="dt-input mx-2 align-middle" id="dt-date-to-c" placeholder="" aria-controls="dt_conference"><button type="button" class="btn btn-danger" id="btn_clear_filter-c">clear filter</button></div>'),
                    bottomStart: 'pageLength',
                    bottom2End: 'info',
                }
            });


            // clear date filter intervention
            $('#btn_clear_filter-c').on('click', function () {

                if ($('#dt-date-to-c').val() || $('#dt-date-from-c').val()) {
                    $('#dt-date-to-c').val('');
                    $('#dt-date-from-c').val('');
                    minDateFilter = "";
                    maxDateFilter = "";
                    aTable.draw();
                }



            });

            // get input dates
            $(function () {

                // get max date (to)
                $("#dt-date-to-c").on("change", function () {

                    let date_to = $('#dt-date-to-c').val();

                    maxDateFilter = new Date(date_to).getTime();
                    aTable.draw();

                });

                // get min date (from)
                $("#dt-date-from-c").on("change", function () {

                    let date_from = $('#dt-date-from-c').val();

                    minDateFilter = new Date(date_from).getTime();
                    aTable.draw();

                });


            });

            // date filter function conference
            $.fn.dataTableExt.afnFiltering.push(
                function (oSettings, aData, iDataIndex) {
                    if (typeof aData._date == 'undefined') {
                        aData._date = new Date(aData[5]).getTime();
                    }

                    if (minDateFilter && !isNaN(minDateFilter)) {
                        if (aData._date < minDateFilter) {
                            return false;
                        }
                    }

                    if (maxDateFilter && !isNaN(maxDateFilter)) {
                        if (aData._date > maxDateFilter) {
                            return false;
                        }
                    }

                    return true;
                }
            );

        })


    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>



    </html>
    <?php
}



?>