<?php
session_start();
$_SESSION['currentpage'] = "madmin";
$username = $_SESSION['username'];
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/manage.css">
    <link rel="stylesheet" href="sidenav/sidenav.css">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/viob.css">
    <script src="js/screen_timeout.js"></script>


</head>

<body>

    <div class="sidenav">
        <?php include('sidenav/sidenav.php'); ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
        <h1>Manage Admin Account</h1>
        <hr>
    </div>
    
       <div class="" style="margin-left: 20px">
            <h2>Change Admin Details</h2>
            <button type="button" id="editButton" class="btn btn-warning mb-3">Edit</button>
                <div class="form-group mb-3" style="width: 400px">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" required disabled>
                </div>
                <div class="form-group mb-3" style="width: 400px">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required disabled>
                </div>
                <div class="form-group mb-3" style="width: 400px">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required disabled>
                </div>
                <div class="form-group mb-3" style="width: 400px">
                    <label for="email_password" class="form-label">Email Password:</label>
                    <input type="password" id="email_password" name="email_password" class="form-control" required disabled>
                </div>
                <button type="submit" id="saveButton" class="btn btn-success" style="display: none;">Save</button>
        </div>
    </div>
</div>
<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #1B4284">
                        <h1 class="modal-title" id="deleteModalLabel" style="color: #fff; font-size:40px">Admin Credentials</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="background-color: #fff"></button>
                    </div>
                    <div class="modal-body text-center">
                        Account details updated successfully.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #1B4284">
                        <h1 class="modal-title" id="deleteModalLabel" style="color: #fff; font-size:40px">Admin Credentials</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="background-color: #fff"></button>
                    </div>
                    <div class="modal-body text-center">
                        Error in updating admin details. Please fill up all fields.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
</section>
</body>
<script>
    var info = [];
   $(document).ready(function() {
    $('#editButton').click(function() {
       if($('#editButton').text() == 'Edit') {
           $('#editButton').text('Cancel Edit');
           $('#editButton').attr('class', 'btn btn-danger mb-3');
           $('#saveButton').show();
           $('#username').prop('disabled', false);
           $('#password').prop('disabled', false);
           $('#email').prop('disabled', false);
           $('#email_password').prop('disabled', false);
       }
       else {
            $('#username').val(info[0].username);
            $('#password').val(info[0].password);
            $('#email').val(info[0].email);
            $('#email_password').val(info[0].email);
           $('#editButton').text('Edit');
           $('#saveButton').hide();
           $('editButton').attr('class', 'btn btn-warning mb-3');
           $('#username').prop('disabled', true);
           $('#password').prop('disabled', true);
           $('#email').prop('disabled', true);
           $('#email_password').prop('disabled', true);
       }
    });

    $.ajax({
        url: 'php/get_admin_details.php',
        type: 'POST',
        success: function(response) {
            $admin_info = JSON.parse(JSON.stringify(response));
            info = $admin_info;
            $('#username').val($admin_info[0].username);
            $('#password').val($admin_info[0].password);
            $('#email').val($admin_info[0].outlook_email);
            $('#email_password').val($admin_info[0].outlook_password);
        }
    })
    $('#saveButton').click(function() {
       if($('#username').val() == '' || $('#password').val() == '' || $('#email').val() == '' || $('#email_password').val() == '') {
           $('#errorModal').modal('show');
           return;
       }
        $('#saveButton').text('Saving...');
        $('#saveButton').prop('disabled', true);
        $.ajax({
            url: 'php/update_admin_details.php',
            type: 'POST',
            data: {
                username: $('#username').val(),
                password: $('#password').val(),
                email: $('#email').val(),
                email_password: $('#email_password').val()
            },
            success: function(response) {
                console.log(response);
                if(response == 'Success') {
                    $('#successModal').modal('show');
                    $('#editButton').text('Edit');
                    $('#saveButton').hide();
                    $('#editButton').attr('class', 'btn btn-warning mb-3');
                    $('#username').prop('disabled', true);
                    $('#password').prop('disabled', true);
                    $('#email').prop('disabled', true);
                    $('#email_password').prop('disabled', true);
                    info[0].username = $('#username').val();
                    info[0].password = $('#password').val();
                    info[0].email = $('#email').val();
                    info[0].email_password = $('#email_password').val();
                    $('#saveButton').text('Save');
                    $('#saveButton').prop('disabled', false);
                }
        
            }
        })
    })
   })
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</html>