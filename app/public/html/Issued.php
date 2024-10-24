<?php
session_start();
$_SESSION['currentpage'] = "issued";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/DOMS_logo.png" type="image/x-icon">
    <title>Manage Admin Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="../css/manage.css"> -->
    <link rel="stylesheet" href="sidenav/sidenav.css">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/violation-report.css">
    <!-- <link rel="stylesheet" href="../css/studentviol.css"> -->
    <link rel="stylesheet" href="sidenav/sidenav.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/screen_timeout.js"></script>
    <link rel="stylesheet" href="../css/viob.css">


</head>

<body>

    <div class="sidenav">
        <?php include('sidenav/sidenav.php'); ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const headerBtn = document.querySelector('.header-btn');
            const sidenav = document.querySelector('.sidenav');

            headerBtn.addEventListener('click', () => {
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
                <h1><i class="fa-solid fa-chevron-left fa-sm me-3 btn_back" onclick="history.go(-1);"
                        style="color: #1b4284;"></i>Issued Documents</h1>
                <hr>
            </div>
            </select>

            <div class="filter-group">
                <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="searchInput" placeholder="Search...">
                </div>
                <div class="dropdowns">


                    <span><i class="fa-solid fa-filter"></i> Date filter</span>

                </div>
            </div>

            <div class="table-nav">
                <div class="nav-list">
                    <ul>
                        <a class="nav-click" style="cursor: pointer; border-bottom: solid 3px rgb(98, 130, 172)"
                            data-name="all">
                            <li>ALL
                                <span id="all_count">0</span>
                            </li>
                        </a>
                        <a class="nav-click" style="cursor: pointer;" data-name="goodmoral">
                            <li>GOOD MORAL
                                <span id="goodmoral_count">0</span>
                            </li>
                        </a>
                        <a class="nav-click" style="cursor: pointer;" data-name="admissionpass">
                            <li>ADMISSION PASS
                                <span id="admission_count">0</span>
                            </li>
                        </a>
                        <a class="nav-click" style="cursor: pointer;" data-name="entrypass">
                            <li>ENTRY PASS
                                <span id="entrypass_count">0</span>
                            </li>
                        </a>

                    </ul>
                </div>
                <div class="generate-btn">
                    <span id="generateReportBtn"><i class="fas fa-chart-bar"></i> Generate Report</span>
                </div>

            </div>

           <!-- Modal DATE -->
           <div id="dateModal" class="modal-date">
                <div class="modal-content-date">

                    <span class="close-date">&times;</span>

                    <div class="date-header">
                        <h2>FILTER DATE</h2>
                    </div>

                    <div class="modal-date-details">

                        <div class="input-date">
                            <label for="from">From</label>
                            <input type="date" name="from">
                        </div>

                        <div class="input-date">
                            <label for="to">To</label>
                            <input type="date" name="to">
                        </div>
                        <button id="fil_apply">APPLY FILTER</button>
                        <button id="fil_clear" style="margin-top: -2%; color: red">CLEAR FILTER</button>
                    </div>

                </div>
            </div>

            <script>
                var modaldate = document.getElementById("dateModal");

                var btndate = document.querySelector(".dropdowns span");

                var spandate = document.getElementsByClassName("close-date")[0];

                btndate.onclick = function() {
                    modaldate.style.display = "block";
                }

                spandate.onclick = function() {
                    modaldate.style.display = "none";
                }

                window.onclick = function(event) {
                    if (event.target == modaldate) {
                        modaldate.style.display = "none";
                    }
                }
            </script>

            <div class="body-table" data-nav="all">
                <table class="table table-hover">
                    <thead>
                        <th>Student ID</th>
                        <th>Request Type</th>
                        <th>Purpose</th>
                        <th>Request Status</th>

                    </thead>
                    <tbody id="tableBody_all" class="table-select">

                    </tbody>
                </table>
            </div>
            <div class="body-table" data-nav="goodmoral" style="display: none;">
                <table class="table table-hover">
                    <thead>
                        <th>Request No</th>
                        <th>Student ID</th>
                        <th>Purpose</th>
                        <th>Date Requested</th>
                        <th>Date Released</th>
                        <th>Request Status</th>
                        <th>Image</th>
                        <th>Action</th>

                    </thead>
                    <tbody id="tableBody_goodmoral" class="table-select">

                    </tbody>
                </table>
            </div>
            <div class="body-table" data-nav="admissionpass" style="display: none;">
                <table class="table table-hover" class="table-select">
                    <thead>
                        <th>Request No</th>
                        <th>Student ID</th>
                        <th>Purpose</th>
                        <th>Date Requested</th>
                        <th>Request Status</th>
                        <th>Date Surrendered</th>
                        <th>Action</th>

                    </thead>
                    <tbody id="tableBody_admissionpass" class="table-select">

                    </tbody>
                </table>
            </div>
            <div class="body-table" data-nav="entrypass" style="display: none;">
                <table class="table table-hover">
                    <thead>
                        <th>Request No</th>
                        <th>Student ID</th>
                        <th>Purpose</th>
                        <th>Date Requested</th>
                        <th>Valid Until</th>
                        <th>Request Status</th>
                        <th>Date Surrendered</th>
                        <th>Action</th>
                    </thead>
                    <tbody id="tableBody_entrypass" class="table-select">

                    </tbody>
                </table>
            </div>

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                </ul>
            </nav>
        </div>
        </div>

        </div>
        </div>


        </div>

        <div class="modal fade " id="goodmoral_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Good Moral</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="add_announcement" class="btn btn-primary">ADD</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="overlayy">
            <img id="overlayImage" src="" alt="Overlay Image">
        </div>

        <!-- DELETE REQUEST MODAL -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteRequestModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #1B4284">
                        <h1 class="modal-title" id="deleteModalLabel" style="color: #fff; font-size:40px">Delete
                            Request</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="background-color: #fff"></button>
                    </div>
                    <div class="modal-body text-center">
                        Do you want to delete this request? This action is irreversible
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="deleteYesBtn">Delete Request</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- EDIT REQUEST    -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editRequestModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #1B4284">
                        <h1 class="modal-title" id="deleteModalLabel" style="color: #fff; font-size:40px">Update
                            Status</h1>
                        <button type="button" class="btn-close closeModal" data-bs-dismiss="modal" aria-label="Close"
                            style="background-color: #fff"></button>
                    </div>
                    <div class="modal-body">

                        <!-- <div class="form-floating"> -->
                        <label for="selectStatus">Status</label>
                        <select class="form-select" id="selectStatus" aria-label="Default select example">
                            <option value="0" selected disabled> -- Select status --</option>
                            <option value="Rejected">Rejected</option>
                            <option value="Accepted">Accepted</option>
                            <!-- <option value="Released">Released</option> -->
                        </select>

                        <label class="mt-3" for="selectStatus" id="labelValidDate" style="display: none">Set Validity
                            for document</label>
                        <input type="date" class="form-control" id="inputValidDate" aria-label="ValidDate"
                            aria-describedby="basic-addon1" style="display: none">


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-warning" id="editYesBtn">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- CLAIM MODAL -->
        <div class="modal fade" id="claimModal" tabindex="-1" aria-labelledby="claimRequestModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #1B4284">
                        <h1 class="modal-title" id="deleteModalLabel" style="color: #fff; font-size:40px">Releasing
                            Request</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="background-color: #fff"></button>
                    </div>
                    <div class="modal-body text-center">
                        Do you want to release this document? This action is irreversible.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="claimYesBtn">Release Request</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- SURRENDER MODAL -->
        <div class="modal fade" id="surrenderModal" tabindex="-1" aria-labelledby="surrenderRequestModal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #1B4284">
                        <h1 class="modal-title" id="deleteModalLabel" style="color: #fff; font-size:40px">Document
                            Surrender</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="background-color: #fff"></button>
                    </div>
                    <div class="modal-body text-center">
                        Do you want to set this document as surrendered? This action is irreversible.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="surrenderYesBtn">Set as Surrendered</button>
                    </div>
                </div>
            </div>
        </div>






    </section>

    <script>
        var select = 'all';
        var search = '';
        var currentPage = 1;
        var itemsPerPage = 10;
        var from = '';
        var to = '';
        $(document).ready(function () {

            $('.nav-click').click(function () {
                $('.nav-click').css('border-bottom', 'none');
                $(this).css('border-bottom', 'solid 3px rgb(98, 130, 172)');
                select = $(this).data('name').toLowerCase();
                $('.body-table').each(function () {
                    $(this).attr('data-nav') === select ? $(this).show() : $(this).hide();
                });
                $('#tableBody_all').empty();
                $('#tableBody_goodmoral').empty();
                $('#tableBody_admissionpass').empty();
                $('#tableBody_entrypass').empty();
                currentPage = 1;
            });

            setInterval(function () {
                $.ajax({
                    url: 'php/get_issued_data.php',
                    method: 'POST',
                    data: {
                        select: select,
                        page: currentPage,
                        limit: itemsPerPage,
                        search: search,
                        from: from,
                        to: to
                    },
                    success: function (response) {
                        // console.log(response);

                        data = JSON.parse(response);
                        request = data.data;
                        total = data.totalPages;
                        totalGoodMoral = data.totalGoodMoral;
                        totalEntryPass = data.totalEntryPass;
                        totalAdmissionPass = data.totalAdmissionPass;
                        totalPass = data.totalPass;
                        console.log(request);
                        $('#tableBody_all').empty();
                        $('#tableBody_goodmoral').empty();
                        $('#tableBody_admissionpass').empty();
                        $('#tableBody_entrypass').empty();
                        if (select == 'all' && request != 'no data') {
                            request.forEach(element => {
                                $('#tableBody_all').append(`<tr class="row-data" data-type="${element.request_type}">
                        <td>${element.student_id}</td>
                        <td>${element.request_type}</td>
                        <td>${element.purpose}</td>
                        <td>${element.status}</td>
                        </tr>`);
                            });
                        } else {
                            $('#tableBody_all').append(`<tr>
                        <td colspan="5">No data</td>
                        </tr>`);
                        }
                        if (select == 'goodmoral' && request != 'no data') {
                            request.forEach(element => {
                                if (element.date_released == null) {
                                    element.date_released = 'N/A';
                                }
                                $('#tableBody_goodmoral').append(`<tr class="row-data" data-type="Good Moral">
                        <td>${element.request_no}</td>
                        <td>${element.student_id}</td>
                        <td>${element.reason}</td>
                        <td>${element.date_requested}</td>
                        <td>${element.date_released}</td>
                        <td>${element.status}</td>
                        <td><img src="../proof_of_payments/${element.proof_of_payment}" alt="" class="image-click"></td>
                        <td style="text-align: end">
                        
                        <i class="fa-solid fa-hand claimGoodmoralBtn" style="color: #5cb85c; cursor: pointer; display:${element.status == 'Pending' ? 'inline' : 'none'}" title="Claim" data-id="${element.request_no}" data-selection="goodmoral" data-bs-toggle="modal" data-bs-target="#claimModal"></i>

                        <i class="fa-solid fa-trash-can deleteGoodmoralBtn" style="color: #D40000; cursor: pointer;" title="Delete" data-id="${element.request_no}" data-selection="goodmoral" data-bs-toggle="modal" data-bs-target="#deleteModal"></i>
                        
                        </td>
                        </tr>`);
                            });
                        } else {
                            $('#tableBody_goodmoral').append(`<tr>
                        <td colspan="7">No data</td>
                        </tr>`);
                        }
                        if (select == 'admissionpass' && request != 'no data') {
                            request.forEach(element => {
                                $('#tableBody_admissionpass').append(`<tr class="row-data" data-type="Admission Pass">
                        <td>${element.request_no}</td>
                        <td>${element.student_id}</td>
                        <td>${element.reason}</td>
                        <td>${element.date_requested}</td>
                        <td>${element.status}</td>
                        <td>${element.date_surrendered ?? ''}</td>
                        <td style="text-align: end">
                        
                        <i class="fa-solid fa-hand claimAdmissionBtn" style="color: #5cb85c; cursor: pointer; display:${element.status == 'Pending' ? 'inline' : 'none'}" title="Release" data-id="${element.request_no}" data-selection="admission" data-bs-toggle="modal" data-bs-target="#claimModal"></i>
                        <i class="fa-solid fa-rotate-left surrenderAdmissionBtn" style="color: #D39200; cursor: pointer; display: ${element.date_surrendered || element.status == 'Pending' ? 'none' : 'inline'} " title="Surrender" data-id="${element.request_no}" data-selection="admission" data-bs-toggle="modal" data-bs-target="#surrenderModal"></i>

                        <i class="fa-solid fa-trash-can deleteAdmissionBtn" style="color: #D40000; cursor: pointer;" title="Delete" data-id="${element.request_no}" data-selection="admission" data-bs-toggle="modal" data-bs-target="#deleteModal"></i>

                        </td>
                        
                        
                        </tr>`);
                            });
                        } else {
                            $('#tableBody_admissionpass').append(`<tr>
                        <td colspan="5">No data</td>
                        </tr>`);
                        }
                        if (select == 'entrypass' && request != 'no data') {
                            request.forEach(element => {
                                if (element.valid_until == null) {
                                    element.valid_until = 'N/A';
                                }
                                $('#tableBody_entrypass').append(`<tr class="row-data" data-type="Entry Pass">
                        <td>${element.request_no}</td>
                        <td>${element.student_id}</td>
                        <td>${element.purpose}</td>
                        <td>${element.date_requested}</td>
                        <td>${element.valid_until}</td>
                        <td>${element.status}</td>
                        <td>${element.date_surrendered ?? ''}</td>
                        <td style="text-align: end">
                        
                        <i class="fa-solid fa-rotate-left surrenderEntryBtn" style="color: #D39200; cursor: pointer; display: ${element.date_surrendered || element.status == 'Pending' ? 'none' : 'inline'} " title="Surrender" data-id="${element.request_no}" data-selection="entry" data-bs-toggle="modal" data-bs-target="#surrenderModal"></i>

                        <i class="fa-solid fa-hand claimEntryBtn" style="color: #5cb85c; cursor: pointer; display: ${element.status == 'Pending' ? 'inline' : 'none'};" title="Release" data-id="${element.request_no}" data-selection="entry" data-bs-toggle="modal" data-bs-target="#claimModal"></i>

                        <i class="fa-solid fa-trash-can deleteEntryBtn" style="color: #D40000; cursor: pointer;" title="Delete" data-id="${element.request_no}" data-selection="entry" data-bs-toggle="modal" data-bs-target="#deleteModal"></i>

                         </td>
                        </tr>`);
                            });
                        } else {
                            $('#tableBody_entrypass').append(`<tr>
                        <td colspan="6">No data</td>
                        </tr>`);
                        }
                        generatePagination(total);
                        $('#all_count').text(totalPass);
                        $('#goodmoral_count').text(totalGoodMoral);
                        $('#entrypass_count').text(totalEntryPass);
                        $('#admission_count').text(totalAdmissionPass);
                    }
                });
            }, 500
            );

            $('#searchInput').on('input', function () {
                search = $(this).val();
                currentPage = 1;
            });

            function generatePagination(totalPages) {
                $('.pagination').empty();
                $('.pagination').append(`
                    <li class="page-item" id="Previous">
                        <a class="page-link" href="#" aria-label="Previous" data-total-page="${totalPages}">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>   `);
                for (let i = 1; i <= totalPages; i++) {
                    $('.pagination').append(
                        `<li class="page-item"><button class="page-link pagination-number" 
                        data-page="${i}" data-total-page="${totalPages}">${i} </button></li>`
                    );
                }
                $('.pagination').append(`<li class="page-item" id="Next">
                    <a class="page-link" href="#" aria-label="Next" data-total-page="${totalPages}">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>`);
                $(`.pagination-number[data-page= '${currentPage}']`).addClass('active');
                if (currentPage === 1) {
                    $('#Previous').addClass('disabled');
                } else {
                    $('#Previous').removeClass('disabled');
                }
                if (currentPage === totalPages) {
                    $('#Next').addClass('disabled');
                } else {
                    $('#Next').removeClass('disabled');
                }
                if (totalPages === 0) {
                    $('#Previous').addClass('disabled');
                    $('#Next').addClass('disabled');
                }
            }

            $('.pagination').on('click', '.page-link', function () {
                // console.log($(this).data('total-page'));
                if ($(this).attr('aria-label') === 'Previous' && currentPage > 1) {
                    currentPage--;
                } else if ($(this).attr('aria-label') === 'Next' && currentPage < $(this).data('total-page')) {
                    currentPage++;
                } else {
                    currentPage = $(this).data('page');
                }
            });

            $('#tableBody_goodmoral').on('click', '.image-click', function () {
                let src = $(this).attr('src');
                $('#overlayImage').attr('src', src);
                $('#overlayy').css('display', 'block');
            });

            $('#overlay').click(function () {
                $(this).css('display', 'none');
            });

            // delete request button
            $('#tableBody_goodmoral').on('click', '.deleteGoodmoralBtn', function (e) {
                $('#deleteYesBtn').data('id', $(this).data('id'));
                $('#deleteYesBtn').attr('reqType', $(this).attr('data-selection'));
            });
            $('#tableBody_admissionpass').on('click', '.deleteAdmissionBtn', function (e) {
                $('#deleteYesBtn').data('id', $(this).data('id'));
                $('#deleteYesBtn').attr('reqType', $(this).attr('data-selection'));
            });
            $('#tableBody_entrypass').on('click', '.deleteEntryBtn', function (e) {
                $('#deleteYesBtn').data('id', $(this).data('id'));
                $('#deleteYesBtn').attr('reqType', $(this).attr('data-selection'));
            });

            $('#deleteYesBtn').click(function () {

                let id = $(this).data('id');
                let reqType = $(this).attr("reqType");
                // console.log(id);
                // console.log(reqType);
                $.ajax({
                    type: 'POST',
                    url: 'php/delete_request.php',
                    data: {
                        id: id,
                        reqType: reqType
                    },
                    success: function (response) {
                        // console.log(response);
                        if (response == 'success') {
                            $('#deleteModal').modal('hide');
                        }
                    }
                });
            });


            // EDIT REQUEST

            $('#selectStatus').change(function () {
                let status = $('#selectStatus').val();
                let reqType = $('#editYesBtn').attr("reqType");

                if (status == 'Accepted' && reqType == 'entry') {
                    $('#labelValidDate').attr('style', 'display: block');
                    $('#inputValidDate').attr('style', 'display: block');
                } else {
                    $('#labelValidDate').attr('style', 'display: none');
                    $('#inputValidDate').attr('style', 'display: none');
                }
            });

            $('.closeModal').click(function () {
                $('#labelValidDate').attr('style', 'display: none');
                $('#inputValidDate').attr('style', 'display: none');
                $('#selectStatus').val('0');
            });

            $('#tableBody_goodmoral').on('click', '.editGoodmoralBtn', function (e) {
                $('#editYesBtn').data('id', $(this).data('id'));
                $('#editYesBtn').attr('reqType', $(this).attr('data-selection'));
            });
            $('#tableBody_admissionpass').on('click', '.editAdmissionBtn', function (e) {
                $('#editYesBtn').data('id', $(this).data('id'));
                $('#editYesBtn').attr('reqType', $(this).attr('data-selection'));
            });
            $('#tableBody_entrypass').on('click', '.editEntryBtn', function (e) {
                $('#editYesBtn').data('id', $(this).data('id'));
                $('#editYesBtn').attr('reqType', $(this).attr('data-selection'));
            });

            $('#editYesBtn').click(function () {

                let id = $(this).data('id');
                let reqType = $(this).attr("reqType");
                let status = $('#selectStatus').val();
                let admin = <?php echo $_SESSION['employee_id'] ?>;
                let date = $('#inputValidDate').val() == '' ? null : $('#inputValidDate').val();

                if (status != null) {
                    $.ajax({
                        type: 'POST',
                        url: 'php/edit_request.php',
                        data: {
                            id: id,
                            reqType: reqType,
                            status: status,
                            admin: admin,
                            date: date
                        },
                        success: function (response) {
                            // console.log(response);
                            if (response == 'success') {
                                $('#editModal').modal('hide');
                            }
                        }
                    });
                }

                $('#selectStatus').val('0');
                $('#labelValidDate').attr('style', 'display: none');
                $('#inputValidDate').attr('style', 'display: none');
            });

            // RELEASE DOCUMENT
            $('#tableBody_goodmoral').on('click', '.claimGoodmoralBtn', function (e) {
                $('#claimYesBtn').data('id', $(this).data('id'));
                $('#claimYesBtn').attr('reqType', $(this).attr('data-selection'));
            });
            $('#tableBody_admissionpass').on('click', '.claimAdmissionBtn', function (e) {
                $('#claimYesBtn').data('id', $(this).data('id'));
                $('#claimYesBtn').attr('reqType', $(this).attr('data-selection'));
            });
            $('#tableBody_entrypass').on('click', '.claimEntryBtn', function (e) {
                $('#claimYesBtn').data('id', $(this).data('id'));
                $('#claimYesBtn').attr('reqType', $(this).attr('data-selection'));
            });

            $('#claimYesBtn').click(function () {

                let id = $(this).data('id');
                let reqType = $(this).attr("reqType");

                // console.log(id);
                // console.log(reqType);

                $.ajax({
                    type: 'POST',
                    url: 'php/claim_request.php',
                    data: {
                        id: id,
                        reqType: reqType,
                    },
                    success: function (response) {
                        // console.log(response);
                        if (response == 'success') {
                            $('#claimModal').modal('hide');
                        }
                    }
                });


            });


            // SURRENDER DOCUMENT
            $('#tableBody_admissionpass').on('click', '.surrenderAdmissionBtn', function (e) {
                $('#surrenderYesBtn').data('id', $(this).data('id'));
                $('#surrenderYesBtn').attr('reqType', $(this).attr('data-selection'));
            });

            $('#tableBody_entrypass').on('click', '.surrenderEntryBtn', function (e) {
                $('#surrenderYesBtn').data('id', $(this).data('id'));
                $('#surrenderYesBtn').attr('reqType', $(this).attr('data-selection'));
            });

            $('#surrenderYesBtn').click(function () {
                let id = $(this).data('id');
                let reqType = $(this).attr("reqType");

                // console.log(id + 'surrender')
                // console.log(reqType + 'surrender')
                $.ajax({
                    type: 'POST',
                    url: 'php/surrender_request.php',
                    data: {
                        id: id,
                        reqType: reqType,
                    },
                    success: function (response) {
                        // console.log(response);
                        if (response == 'success') {
                            $('#surrenderModal').modal('hide');
                        }
                    }
                });

            });


            $('#tableBody_goodmoral').on('click', '.image-click', function () {
                let src = $(this).attr('src');
                $('#overlayImage').attr('src', src);
                $('#overlay').css('display', 'block');
            });
            $('#generateReportBtn').click(function () {
                window.location.href = 'php/generate_Issued_report.php';
            });
            $('#fil_apply').on('click', function(){
                from = $('input[name="from"]').val();
                to = $('input[name="to"]').val();
                $('#dateModal').css('display', 'none');
                
            })
            $('#fil_clear').on('click', function(){
                from = '';
                to = '';
                $('input[name="from"]').val('');
                $('input[name="to"]').val('');
                $('#dateModal').css('display', 'none');
            })
        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>