<?php
session_start();
$_SESSION['currentpage'] = "violation";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/DOMS_logo.png" type="image/x-icon">
    <title>Lost & Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/violation-report.css">
    <link rel="stylesheet" href="../css/viob.css">
    <link rel="stylesheet" href="sidenav/sidenav.css">
    <link rel="stylesheet" href="../css/general.css">
    <script src="js/screen_timeout.js"></script>



    <style>
        td img {
            object-fit: cover;
            height: 30px;
            width: 30px;
        }
    </style>
</head>

<body>

    <div class="sidenav">
        <?php
        include('sidenav/sidenav.php');
        ?>
    </div>

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
                <h1><i class="fa-solid fa-chevron-left fa-sm me-3 btn_back" onclick="history.go(-1);"
                        style="color: #1b4284;"></i>Violation Report</h1>
                <hr>
            </div>
            <!-- 
            <?php
            // echo '<button class="back-button-viocon" onclick="history.back()">> Back</button>';
            ?> -->

<div class="filter-group">
                <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search..." id="searchInput">
                </div>
                <div class="dropdown-lang">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="section"
                        data-bs-toggle="dropdown" aria-expanded="false" data-box="section">Section</button>
                    <ul class="dropdown-menu" id="detect-section" aria-labelledby="section">
                        <input type="text" class="form-control input-lang" placeholder="Search sections..."
                            onkeydown="return /[a-zA-Z1-9]/i.test(event.key)">
                            <?php include('php/get_section.php'); ?>
                    </ul>
                </div>

                <div class="dropdown-lang">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="section"
                        data-bs-toggle="dropdown" aria-expanded="false" data-box="course">Course</button>
                    <ul class="dropdown-menu" id="detect-Course" aria-labelledby="section">
                        <input type="text" class="form-control input-lang" placeholder="Search courses..."
                            onkeydown="return /[a-zA-Z]/i.test(event.key)">
                            <?php include('php/get_course.php'); ?>
                    </ul>
                </div>

                <div class="dropdown-lang">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="section"
                        data-bs-toggle="dropdown" aria-expanded="false" data-box="department">Department</button>
                    <ul class="dropdown-menu" id="detect-department" aria-labelledby="section">
                        <input type="text" class="form-control input-lang" placeholder="Search departments..."
                            onkeydown="return /[a-zA-Z]/i.test(event.key)">
                            <?php include('php/get_department.php'); ?>
                    </ul>
                </div> 
            </div>

            <div class="table-nav">
                <div class="nav-list">
                    <ul>
                        <a style="cursor: pointer; border-bottom: solid 3px rgb(98, 130, 172)" data-nav="all">
                            <li>ALL VIOLATION <span id="all_count">0</span></li>
                        </a>
                        <a style="cursor: pointer;" data-nav="minor">
                            <li>MINOR VIOLATION <span id="minor_count">0</span></li>
                        </a>
                        <a style="cursor: pointer;" data-nav="major">
                            <li>MAJOR VIOLATION <span id="major_count">0</span></li>
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

                        <button id="applyFilterBtn">APPLY FILTER</button>
                    </div>

                </div>
            </div>



            </script>


            <div class="body-table">
                <table class="nav-table" data-nav="all">
                    <thead>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Course</th>
                        <th>Offense</th>
                        <th>Violation</th>
                        <th>Status</th>
                        <th>Date created</th>
                    </thead>
                    <tbody id="tableBody_all">

                    </tbody>
                </table>

                <table class="nav-table" data-nav="minor" style="display: none;">
                    <thead>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Course</th>
                        <th>Offense</th>
                        <th>Violation</th>
                        <th>Date created</th>
                    </thead>
                    <tbody id="tableBody_minor">

                    </tbody>
                </table>

                <table class="nav-table" data-nav="major" style="display: none;">
                    <thead>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Course</th>
                        <th>Offense</th>
                        <th>Violation</th>
                        <th>Status</th>
                        <th>Date created</th>
                        <th>Action</th>
                    </thead>
                    <tbody id="tableBody_major">

                    </tbody>
                </table>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const applyFilterBtn = document.getElementById('applyFilterBtn');

                        applyFilterBtn.addEventListener('click', function () {
                            const fromDate = document.querySelector('input[name="from"]').value;
                            const toDate = document.querySelector('input[name="to"]').value;

                            const xhr = new XMLHttpRequest();
                            xhr.open('POST', 'php/filter_report_data.php');
                            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                            xhr.onload = function () {
                                if (xhr.status === 200) {
                                    document.getElementById('tableBody').innerHTML = xhr.responseText;
                                }
                            };
                            xhr.send(`fromDate=${fromDate}&toDate=${toDate}`);
                        });
                    });
                </script>

            </div>

        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">

            </ul>
        </nav>
        </div>

    </section>
</body>
<script>
    var selected = 'all';
    var search = '';
    var currentPage = 1;
    var itemsPerPage = 5;
    var section = '';
    var course = '';
    var department = '';
    $(document).ready(function () {
        $('.nav-list ul a').click(function () {
            $('.nav-list ul a').css('border-bottom', 'none');
            currentPage = 1;
            selected = $(this).attr('data-nav');
            $('.nav-table').each(function () {
                ($(this).attr('data-nav') == selected) ? $(this).css('display', 'block') : $(this).css('display', 'none');
            })
            $(this).css('border-bottom', 'solid 3px rgb(98, 130, 172)');
        });
        setInterval(function () {
            $.ajax({
                url: 'php/violation_report_data.php',
                type: 'POST',
                data: {
                    selected: selected,
                    search: search,
                    page: currentPage,
                    limit: itemsPerPage,
                    section: section,
                    course: course,
                    department: department
                },
                success: function (response) {
    console.log(response);
    let data = JSON.parse(JSON.stringify(response));
    let violations = data.all;
    let totalPages = data.totalPages;
    let minorCount = data.minorCount;
    let majorCount = data.majorCount;
    let combinedCount = data.combinedCount;
    $('#tableBody_all').empty();
    $('#tableBody_minor').empty();
    $('#tableBody_major').empty();

    if (violations.length === 0) {
        if (selected == 'all') {
            $('#tableBody_all').append(`
                <tr>
                    <td colspan="7">No data found</td>
                </tr>
            `);
        } else if (selected == 'minor') {
            $('#tableBody_minor').append(`
                <tr>
                    <td colspan="6">No data found</td>
                </tr>
            `);
        } else if (selected == 'major') {
            $('#tableBody_major').append(`
                <tr>
                    <td colspan="8">No data found</td>
                </tr>
            `);
        }
    } else {
        violations.forEach(item => {
            if (selected == 'all') {
                $('#tableBody_all').append(`
                    <tr>
                        <td>${item.student_id}</td>
                        <td>${item.name} ${item.lastname}</td>
                        <td>${item.course_name}</td>
                        <td>${item.violation_type}</td>
                        <td>${item.violation_name}</td>
                        <td>${item.status}</td>
                        <td>${item.date_of_apprehension}</td>
                    </tr>
                `);
            } else if (selected == 'minor') {
                $('#tableBody_minor').append(`
                    <tr>
                        <td>${item.student_id}</td>
                        <td>${item.name} ${item.lastname}</td>
                        <td>${item.course_name}</td>
                        <td>${item.violation_type}</td>
                        <td>${item.violation_name}</td>
                        <td>${item.date_of_apprehension}</td>
                    </tr>
                `);
            } else if (selected == 'major') {
                $('#tableBody_major').append(`
                    <tr>
                        <td>${item.student_id}</td>
                        <td>${item.name} ${item.lastname}</td>
                        <td>${item.course_name}</td>
                        <td>${item.violation_type}</td>
                        <td>${item.violation_name}</td>
                        <td>${item.status}</td>
                        <td>${item.date_of_apprehension}</td>
                        <td><button class="btn btn-primary" style="font-size: 10px">Send Email</button></td>
                    </tr>
                `);
            }
        });
    }
    console.log(totalPages);
                    generatePagination(totalPages);
                    $('#all_count').text(combinedCount);
                    $('#minor_count').text(minorCount);
                    $('#major_count').text(majorCount);
}
            });
        }, 500);

        function generatePagination(totalPages) {
            $('.pagination').empty();
            $('.pagination').append(`
        <li class="page-item" id="Previous">
        <a class="page-link" href="#" aria-label="Previous" data-total-page="${totalPages}">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
      `);
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
        $('')
        $('.pagination').on('click', '.page-link', function () {
            console.log($(this).data('total-page'));
            if ($(this).attr('aria-label') === 'Previous' && currentPage > 1) {
                currentPage--;
            } else if ($(this).attr('aria-label') === 'Next' && currentPage < $(this).data('total-page')) {
                currentPage++;
            } else {
                currentPage = $(this).data('page');
            }

        });

        $('.generate-btn').on('click', '#generateReportBtn', function () {
            window.location.href = './php/generate_violation_report.php';
        });
        $('.dropdown-item').on('click', function () {
            const tabPane = $(this).closest('.dropdown-lang');
            const button = tabPane.find('button.dropdown-toggle');
            if ($(this).text() === button.text() && button.attr('data-box') === 'section') {
                button.text('Section');
                section = '';
            } else if ($(this).text() === button.text() && button.attr('data-box') === 'course') {
                button.text('Course');
                course = '';
            } else if ($(this).text() === button.text() && button.attr('data-box') === 'department') {
                button.text('Department');
                department = '';
            } else {
                if (button.attr('data-box') === 'section') {
                    section = $(this).text();
                } else if (button.attr('data-box') === 'course') {
                    course = $(this).text();
                } else if (button.attr('data-box') === 'department') {
                    department = $(this).text();
                }
                const text = $(this).text();
                button.text(text);
                $(this).attr('style', 'background-color: rgb(0,2550);');
            }
        })
        $('#searchInput').on('input', function () {
            search = $(this).val();
            currentPage = 1;
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</html>