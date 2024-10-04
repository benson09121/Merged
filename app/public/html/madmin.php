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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <h1>Manage Admin Account</h1>
                <hr>
            </div>

            <div class="" style="margin-left: 20px">
                <div class="row">
                    <h2>Change Admin Details</h2>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" id="add-content"class="btn btn-status active btn-success"
                            style="margin-top: -3%">Add</button>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="admin_body">
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        <!-- Success Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #1B4284">
                        <h1 class="modal-title" id="deleteModalLabel" style="color: #fff; font-size:40px">Admin
                            Credentials</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="background-color: #fff"></button>
                    </div>
                    <div class="modal-body text-left">
                        <div class="mb-3">
                            <label for="username_add" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username_add">
                        </div>
                        <div id="add_error_username" style="margin-top: -4%; color: red; display: none">Fill up the username field</div>
                        <div class="mb-3">
                            <label for="password_add" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password_add">
                        </div>
                        <div id="add_password_username" style="margin-top: -4%; color: red; display: none">Fill up the password field</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="add-admin" data-id="">Add</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #1B4284">
                        <h1 class="modal-title" id="deleteModalLabel" style="color: #fff; font-size:40px">Admin
                            Credentials</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="background-color: #fff"></button>
                    </div>
                    <div class="modal-body text-left">
                        <div class="mb-3">
                            <label for="username_edit" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username_edit">
                        </div>
                        <div id="edit_error_username" style="margin-top: -4%; color: red; display: none">Fill up the username field</div>
                        <div class="mb-3">
                        <div class="mb-3">
                            <label for="password_edit" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password_edit">
                        </div>
                        <div id="edit_password_username" style="margin-top: -4%; color: red; display: none">Fill up the password field</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="edit-admin" data-id="">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #1B4284">
                        <h1 class="modal-title" id="deleteModalLabel" style="color: #fff; font-size:40px">Admin
                            Credentials</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="background-color: #fff"></button>
                    </div>
                    <div class="modal-body text-left">
                        Are you sure you want to delete this admin?
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="delete-admin" data-id="">Yes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </section>
</body>
<script>
    $(document).ready(function () {
        function load_admin() {
            $.ajax({
                url: 'php/load_admin.php',
                type: 'POST',
                success: function (data) {
                    console.log(data);
                    data = JSON.parse(data);
                    data.forEach(function (admin) {
                        $('#admin_body').append(`
                    <tr>
                        <td>${admin.employee_id}</td>
                        <td>${admin.username}</td>
                        <td>${admin.password}</td>
                        <td>
                            <button type="button" class="btn btn-status active btn-success btn-edit" style="margin-top: -3%">Edit</button>
                            <button type="button" class="btn btn-status active btn-danger btn-delete" style="margin-top: -3%">Delete</button>
                        </td>
                    </tr>
                    `)
                    })
                }
            })
        }
        load_admin();
        $('#admin_body').on('click', '.btn-edit', function () {
            let row = $(this).closest('tr');
            let username = row.find('td:eq(1)').text();
            let password = row.find('td:eq(2)').text();
            let id = row.find('td:eq(0)').text();
            $('#editModal').find('.btn-success').attr('data-id', id);
            $('#username_edit').val(username);
            $('#password_edit').val(password);
            $('#editModal').modal('show');
        })
        $('#admin_body').on('click', '.btn-delete', function () {
            let row = $(this).closest('tr');
            let id = row.find('td:eq(0)').text();
            $('#deleteModal').find('.btn-danger').attr('data-id', id);
            $('#deleteModal').modal('show');
        })
        $('#add-content').on('click', function(){
        $('#addModal').modal('show');
    })
    $('#delete-admin').on('click', function () {
        let id = $(this).attr('data-id');
        $.ajax({
            url: 'php/delete_admin.php',
            type: 'POST',
            data: {
                id: id
            },
            success: function (data) {
                console.log(data);
                $('#deleteModal').modal('hide');
                $('#admin_body').empty();
                load_admin();
            }
        })
    })
        $('#add-admin').on('click', function () {
            let username = $('#username_add').val();
            let password = $('#password_add').val();
            if(username == ''){
                $('#add_error_username').show();
                return;
            }
            if(password == ''){
                $('#add_password_username').show();
                return;
            }
            $.ajax({
                url: 'php/add_admin.php',
                type: 'POST',
                data: {
                    username: username,
                    password: password
                },
                success: function (data) {
                    console.log(data);
                    if(data == 'Success'){
                        $('#addModal').modal('hide');
                        $('#admin_body').empty();
                        $('#username_add').val('');
                        $('#password_add').val('');
                        $('#add_error_username').hide();
                        $('#add_password_username').hide();
                        load_admin();
                    }
                }
            })
        })
        $('#edit-admin').on('click', function () {
            let username = $('#username_edit').val();
            let password = $('#password_edit').val();
            if(username == ''){
                $('#edit_error_username').show();
                return;
            }
            let id = $(this).attr('data-id');
            $.ajax({
                url: 'php/edit_admin.php',
                type: 'POST',
                data: {
                    username: username,
                    password: password,
                    id: id
                },
                success: function (data) {
                    console.log(data);
                    $('#editModal').modal('hide');
                    $('#admin_body').empty();
                    $('#username_edit').val('');
                    $('#password_edit').val('');
                    $('#edit_error_username').hide();
                    $('#edit_password_username').hide();
                    load_admin();
                }
            })
        })
        $('#addModal').on('hidden.bs.modal', function () {
            $('#username_add').val('');
            $('#password_add').val('');
            $('#add_error_username').hide();
            $('#add_password_username').hide();
        })
        $('#editModal').on('hidden.bs.modal', function () {
            $('#username_edit').val('');
            $('#password_edit').val('');
            $('#edit_error_username').hide();
            $('#edit_password_username').hide();
        })
    })


    
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</html>