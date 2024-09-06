<?php
session_start();
$_SESSION['currentpage'] = "violation";
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
</head>

<body id="violation_main">

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

    <section class="main-do" id="main_body">


        <div class="body-content">

                <div class="form-container">

                    <div class="student-violation">
                        <div class="student-header info-header">
                            <h1>Student Violation</h1>
                            <hr>
                        </div>

                        <div class="table-nav">
                            <div class="nav-list">
                                <ul>
                                    <a href="#" style="border-bottom: solid 3px rgb(98, 130, 172)">
                                        <li>SINGLE VIOLATION</li>
                                    <fa>
                                    <a href="multiple-violation.php">
                                        <li>MULTIPLE VIOLATION</li>
                                    </a>
                                    <a href="multiple-students.php">
                                        <li>MULTIPLE STUDENTS</li>
                                    </a>
                                </ul>
                            </div>
                        </div>

                        <hr>

                        <div class="student-content">

                            <div class="student-left info-left">
                                <div class="student-info info">
                                    <div class="left">
                                        <label>Search student:</label>
                                        
                                    </div>
                                    <div class="middle">
                                        <input type="text" name="studentID" id="studentID" required>
                                    </div>
                                </div>
                                <div class="guide">
                                    <div style="overflow: auto; width: 520px; height: 150px">
                                    <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <td>Student ID</td>
                                                    <td>Student Name</td>
                                                    <td>Course</td>
                                                </tr>
                                            </thead>
                                            <tbody id="student_body">
                                           
                                            </tbody>
                                        </table>
                                    </div>
                                
                                </div>

                                <div class="guide2">
                                <!-- <table>
                                    <tbody>
                                        <thead>
                                        <td>Student_ID</td>
                                        <td>Student Name</td>
                                        <td>Course</td>
                                        <td>Action</td>
                                        </thead>
                                    </tbody>
                                   </table> -->
                                </div>
                            </div>

                            <div class="right">
                                <button type="button" id="viewProfileBtn">View Student Profile</button>
                            </div>

                        </div>

                    </div>

                    <hr>

                    <div class="violation-header info-header">
                        <div class="violation_slip">
                            <h4>Violation Slip</h4>
                        </div>
                        <div class="date" id="currentDate"></div>
                    </div>

                    <div class="violation-container">

                        <div class="violation-left info-left">
                            <div class="info">
                                <div class="left">
                                    <label>Student ID:</label>
                                    <label>Name:</label>
                                    <label>Course & Section:</label>
                                    <label>Offense Type:</label>
                                    <label>Violation Type:</label>
                                    <label>Description:</label>
                                    <label id="category_txt">Category:</label>

                                </div>
                                <div class="middle">
                                    <input id="studentIDField" name="student_id_pass" placeholder="" readonly></input>
                                    <input id="nameField" readonly></input>
                                    <input id="courseField" readonly></input>
                                    <select id="offense_type" name="offense_type" required disabled>
                                        <option value="" style="display: none;">Select Offense Type</option>
                                        <option value="Major">Major offense</option>
                                        <option value="Minor">Minor offense</option>
                                    </select>

                                    <select id="violation_type" name="violation_type" required disabled>
                                        <option value="" style="display: none;">Select Violation Type</option>
                                    </select>

                                    <textarea id="desicriptionField" name="description" readonly></textarea>

                                    <select id="category_type" name="category_type" disabled>
                                        <option value="" style="display: none;">Select Category</option>
                                    </select>

                                </div>
                            </div>

                        </div>


                        <div class="right">
                            <p style="display: none; color: red" id="error">Fill in the fields to continue</p>
                            <button id="next_btn">Next</button>
                        </div>

                    </div>

                    <hr>
                </div>

        </div>

        <!-- Modal Structure -->
        <div id="studentProfileModal" class="modal">
            <div class="modal-content1">

                <span class="close">&times;</span>

                <div class="modal-name">
                    <h1 id="stundet_name"></h1>
                    <p id="student_id"></p>
                </div>

                <div class="modal-body">

                    <div class="modal-details">

                        <div class="input-wrap">
                            <label>Course & Section:</label>
                            <p id="stundet_course"></p>
                        </div>

                        <div class="input-wrap">
                            <label>Department:</label>
                            <p id="stundet_dept"></p>
                        </div>

                        <div class="input-wrap">
                            <label>School Email:</label>
                            <p id="stundet_email"></p>
                        </div>

                    </div>

                    <hr>

                    <div class="modal-record">
                        <div class="record-header">
                            <h1>Student Record</h1>
                            <div class="record-offense">
                                <div class="minor-major">
                                    <h4>Major Offense: <span>1</span></h4>
                                </div>
                                <div class="minor-major">
                                    <h4>Minor Offense: <span>1</span></h4>
                                </div>
                            </div>
                        </div>

                        <div class="modal-table">
                            <table>
                                <thead>
                                    <th>Offense Type</th>
                                    <th>Violation Type</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </thead>
                                <tbody id="violationTableBody">


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- SELECT MODAL -->
<div class="modal fade" id="success_minor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Success</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Minor violation has been successfully recorded.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    </section>
    <script>
        var category = '';
        var search = '';
        $(document).ready(function(){
            $('#studentID').on('input', function(){
                search = $(this).val();
            })
            setInterval(() => {
            $.ajax({
                type: 'POST',
                data: {
                    search: search
                },
                url: 'php/fetch_student.php',
                success: function(response){
                    var student = JSON.parse(response);
                    $('#student_body').empty();
                    student.forEach(element => {
                        $('#student_body').append(`
                        <tr style="cursor: pointer" class="row_student">
                            <td>${element.student_id}</td>
                            <td>${element.f_name} ${element.l_name}</td>
                            <td>${element.course}</td>`);
                    });
                }
            })
        }, 500);
        $('#student_body').on('click', '.row_student', function(){
            var student_id = $(this).find('td').eq(0).text();
            $('#studentID').val(student_id);
            search = student_id;
            $('#studentID').trigger('keyup');
        })
            $('.modal').on('shown.bs.modal', function() {
  //Make sure the modal and backdrop are siblings (changes the DOM)
  $(this).before($('.modal-backdrop'));
  //Make sure the z-index is higher than the backdrop
  $(this).css("z-index", parseInt($('.modal-backdrop').css('z-index')) + 1);
});
            $('#studentID').on('keyup', function(){
                var studentID = $(this).val();
                    $.ajax({
                        url: 'php/fetch_student_data.php',
                        type: 'POST',
                        data: {student_id: studentID},
                        success: function(response){
                            if(response == 'error'){
                                $('#studentIDField').val('');
                            $('#nameField').val('');
                            $('#courseField').val('');
                            $('#minor_count').val('');
                            $('#major_count').val('');
                            $('#viewProfileBtn').attr('disabled', true);
                            $('#offense_type').attr('disabled', true);
                            $('#violation_type').attr('disabled', true);
                            $('#category_type').attr('disabled', true);
                                return;
                            }
                            var student = JSON.parse(response);
                            $('#studentIDField').val(student[0].student_id);
                            $('#nameField').val(student[0].f_name + ' ' + student[0].m_name + ' ' + student[0].l_name);
                            $('#courseField').val(student[0].course + ' - ' + student[0].section);
                            $('#minor_count').val(student[0].minor_offense);
                            $('#major_count').val(student[0].major_offense);
                            $('#emailField').val(student[0].email);
                            $('#nameField1').val(student[0].f_name + ' ' + student[0].m_name + ' ' + student[0].l_name);
                            $('#viewProfileBtn').attr('disabled', false);
                            $('#offense_type').attr('disabled', false);
                        }
                    });
            });
            $('#viewProfileBtn').on('click', function(){
                $('#studentProfileModal').css('display', 'block'); 
            })
            $('.close').on('click', function(){
                $('#studentProfileModal').css('display', 'none');
            })
            $.ajax({
                url: 'php/fetch_category_type.php',
                type: 'GET',
                success: function(response){
                    var category = JSON.parse(response);
                    category.forEach(element => {
                        $('#category_type').append('<option value="'+element.penalty_id+'">'+element.penalty_name+'</option>');
                    });
                }
            })
            $('#offense_type').on('change', function(){
                $('#violation_type').attr('disabled', false);
                var offense_type = $(this).val();
                if(offense_type == 'Major'){
                    $.ajax({
                        url: 'php/fetch_major_violation.php',
                        type: 'GET',
                        success: function(response){
                            $('#violation_type').empty();
                            var violation = JSON.parse(response);
                            $('#violation_type').html('<option value="" style="display: none;">Select Violation Type</option>');
                            violation.forEach(element => {
                                if(element.violation_name.length > 100){
                                    element.violation_name = element.violation_name.substring(0, 100) + '...';
                                }
                                $('#violation_type').append('<option value="'+element.violation_id+'">'+element.violation_name+'</option>');
                            });
                        }
                    })
                    $('#category_type').attr('disabled', false);
                } else{
                    $.ajax({
                        url: 'php/fetch_minor_violation.php',
                        type: 'GET',
                        success: function(response){

                            $('#violation_type').empty();
                            var violation = JSON.parse(response);
                            $('#violation_type').html('<option value="" style="display: none;">Select Violation Type</option>');
                            violation.forEach(element => {
                                if(element.violation_name.length > 100){
                                    element.violation_name = element.violation_name.substring(0, 100) + '...';
                                }
                                $('#violation_type').append('<option value="'+element.violation_id+'">'+element.violation_name+'</option>');
                            });
                        }
                    })
                    $('#category_txt').text('Category:');
                    $('#category_type').attr('disabled', true);
                }
            })
            $('#next_btn').on('click', function(){
                if('#studentIDField' == ''){
                    $('#error').css('display', 'block');
                    return;
                }
                if($('#offense_type').val() == ''){
                    $('#error').css('display', 'block');
                    return;
                }
                if($('#violation_type').val() == ''){
                    $('#error').css('display', 'block');
                    return;
                }
                if($('#category_type').val() == '' && $('#offense_type').val() == 'Major'){
                    $('#error').css('display', 'block');
                    return;
                } else{
                    if($('#offense_type').val() == 'Major'){
                        $('#service').attr('disabled', false);
                        $('#service').css('display', 'block');
                        if($('#category_type').val() == '1'){
                            category = '1';
                            console.log('HELLO');
                           $('#title_category').text('Categpry ' + category);
                           $('#service').attr('disabled', true);
                           $('#service').css('display', 'none');
                        }
                        $('#nextstep').css('display', 'block');
                    $('#main_body').css('display', 'none');
                    $('#error').css('display', 'none');
                    } else{
                        $('#error').css('display', 'none');
                        $.ajax({
                            url: 'php/insert_minor_violation.php',
                            type: 'POST',
                            data: {
                                student_id: $('#studentIDField').val(),
                                violation_type: $('#violation_type').val(),
                            },
                            success: function(response){
                                console.log(response);
                                if(response == 'success'){
                                    $('#error').css('display', 'none');
                                    $('#studentIDField').val('');
                                    $('#nameField').val('');
                                    $('#courseField').val('');
                                    $('#offense_type').val('');
                                    $('#violation_type').val('');
                                    $('#error').css('display', 'none');
                                    $('#studentID').val('');
                                    $('#studentID').trigger('keyup');
                                    $('#error').css('display', 'none');
                                    $('#success_minor').modal('show');
                                } else{
                                    $('#error').css('display', 'block');
                                }
                            }
                        })
                    }

                }
            })

        })
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
    <?php include('category2-community.php'); ?>

</body>


</html>