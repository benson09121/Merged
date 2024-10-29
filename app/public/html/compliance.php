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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css" rel="stylesheet">

        <script src="js/screen_timeout.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- <script src="https://cdn.datatables.net/v/dt/dt-2.1.8/datatables.min.js"></script> -->
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
        <!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> -->
        <!-- <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script> -->


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
                            style="color: #1b4284;"></i>Student Compliance</h1>
                    <hr>
                </div>

                <hr>
                <div class="filters d-flex justify-content-between my-4 ms-3">
                    <div class="search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input class="border-0 type=" text" id="input_search" placeholder="Search...">
                    </div>

                    <span class="text-secondary" id="btn_dateFilter" onclick="btn_dateFilter()"
                        style="font-size:1.2rem; cursor:pointer"><i class="fa-solid fa-filter"></i>Date Filter</span>
                </div>
                <hr>

                <!-- navigation -->
                <nav class="mx-3 navigation">
                    <div class="nav nav-underline " id="nav-tab" role="tablist">
                        <button class="nav-link me-4 active" id="nav-intervention-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-intervention" type="button" role="tab" aria-controls="nav-intervention"
                            aria-selected="true">INTERVENTION<span class="count"><?php
                            include('php/getIntervention.php');
                            echo count($data);
                            ?></span></button>
                        <button class="nav-link" id="nav-conference-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-conference" type="button" role="tab" aria-controls="nav-conference"
                            aria-selected="false">CONFERENCE<span class="count"><?php
                            include 'php/getConference.php';
                            echo count($dataConference);
                            ?></span></button>
                    </div>
                </nav>


                <!-- tabs -->
                <div class="tab-content mt-1" id="nav-tabContent">
                    <!-- intervention tab -->
                    <div class="tab-pane fade show active" id="nav-intervention" role="tabpanel"
                        aria-labelledby="nav-intervention-tab" tabindex="0">
                        <div class="ms-3 table-responsive">
                            <table id="dt_intervention" class="table table-striped mt-4" style="width:100%">
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
                            <table id="dt_conference" class="table table-striped mt-4" style="width:100%">
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
                                    // include 'php/getConference.php';
                                
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
            <div id="dateModal" class="modal-date">
                <div class="modal-content-date">

                    <span class="close-date">&times;</span>

                    <div class="date-header">
                        <h2>FILTER DATE</h2>
                    </div>

                    <div class="modal-date-details">

                        <div class="input-date">
                            <label for="from">From</label>
                            <input type="date" id="filter-from">
                        </div>

                        <div class="input-date">
                            <label for="to">To</label>
                            <input type="date" id="filter-to">
                        </div>
                        <button id="fil_apply">APPLY FILTER</button>
                        <button id="fil_clear" style="margin-top: -2%; color: red">CLEAR FILTER</button>
                    </div>

                </div>
            </div>
            <script>

                var modaldate = document.getElementById("dateModal");

                var spandate = document.getElementsByClassName("close-date")[0];

                function btn_dateFilter() {
                    modaldate.style.display = "block";
                }

                spandate.onclick = function () {
                    modaldate.style.display = "none";
                }

                window.onclick = function (event) {
                    if (event.target == modaldate) {
                        modaldate.style.display = "none";
                    }
                }
            </script>

        </section>

    </body>

    <script>


        function toConf() {

        }


        $(document).ready(function () {


            const intCount = $('#dt_intervention').attr("data-count");
            const conCount = $('#dt_conference').attr("data-count");

            // intervention datatable initialization
            var oTable = $('#dt_intervention').DataTable({
                layout: {
                    // top2start: 'search',
                    topStart: null,
                    // topStart: $('<nav class="mx-3 navigation"><div class="nav nav-underline " id="nav-tab" role="tablist"> <button class="nav-link position-relative active me-4" data-bs-toggle="tab" data-bs-target="#nav-intervention" type="button" role="tab"aria-controls="nav-intervention" aria-selected="true" style="color:#1b4284" >INTERVENTION<span class="text-secondary" style="font-size: .9rem; background-color: #daf6ff; color: rgb(128, 152, ); padding: 3px; border-radius: 5px; margin-left: 5px;">' + intCount + '</span></button><button class="nav-link position-relative" id="nav-conference-tab" data-bs-toggle="tab" data-bs-target="#nav-conference" type="button" role="tab" aria-controls="nav-conference" aria-selected="false" >CONFERENCE<span class="text-secondary" style="font-size: .9rem; background-color: #daf6ff; color: rgb(128, 152, ); padding: 3px; border-radius: 5px; margin-left: 5px;">' + conCount + '</span></button></div></nav><button onclick="toConf()">click</button>'),
                    topEnd: null,
                    bottomStart: null,
                }
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
                    // top2start: 'search',
                    // topStart: $('<nav class="mx-3 navigation"><div class="nav nav-underline " id="nav-tab" role="tablist"> <button class="nav-link position-relative me-4" id="nav-intervention-tab" data-bs-toggle="tab" data-bs-target="#nav-intervention" type="button" role="tab"aria-controls="nav-intervention" aria-selected="true" >INTERVENTION<span class="" style="font-size: .9rem; background-color: #daf6ff; color: rgb(128, 152, ); padding: 3px; border-radius: 5px; margin-left: 5px;">' + intCount + '</span></button><button class="nav-link position-relative active" id="nav-conference-tab" data-bs-toggle="tab" data-bs-target="#nav-conference" type="button" role="tab" aria-controls="nav-conference" aria-selected="false" style="color:#1b4284">CONFERENCE<span class="text-secondary" style="font-size: .9rem; background-color: #daf6ff; color: rgb(128, 152, ); padding: 3px; border-radius: 5px; margin-left: 5px;">' + conCount + '</span></button></div></nav>'),
                    topEnd: null,
                    topStart: null,
                    bottomStart: null,
                    // bottom2End: 'pageLength',
                }
            });



            $('#fil_apply').on('click', function () {

                // let target = $('#dateModal').val();
                let date_to2 = $('#filter-to').val();
                let date_from2 = $('#filter-from').val();

                // console.log(target);
                // console.log(date_to2);
                // console.log(date_from2);

                maxDateFilter = new Date(date_to2).getTime();
                minDateFilter = new Date(date_from2).getTime();

                dt_draw();

                $('#filter-from').val('');
                $('#filter-to').val('');
                modaldate.style.display = "none";

            });

            $('#fil_clear').on('click', function () {
                // let target = $('#dateModal').data('id');
                $('#filter-from').val('');
                $('#filter-to').val('');
                maxDateFilter = '';
                minDateFilter = '';
                dt_draw();
                modaldate.style.display = "none";

            })

            function dt_draw() {
                oTable.draw();
                // console.log('int draw');
                aTable.draw();
                // console.log('conf draw');
            }

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

            // search function
            $('#input_search').keyup(function () {
                oTable.search($(this).val()).draw();
                aTable.search($(this).val()).draw();
            })

        })


    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    </html>
    <?php
}



?>