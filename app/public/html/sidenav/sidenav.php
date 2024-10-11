<?php
$currentpage = isset($_SESSION['currentpage']) ? $_SESSION['currentpage'] : '';
$admin_role = $_SESSION['role'];
?>


<div class="top-sidenav">
    <div class="sidenav-btn">
        <i class="fas fa-bars"></i>
    </div>
    <div class="nu">
        <img src="../images/DOMS_logo1.png" alt="img">
        <h6>DISCIPLINE OFFICE</h6>
        <hr>
        <p>Management System.</p>
    </div>
</div>
<div class="menu">
    <!-- Show common menu items for Admin and SuperUser roles -->
    <?php if ($admin_role == 'Admin'): ?>
        <a <?php if ($currentpage != 'home') {
            echo 'href="home.php"';
        } else {
            echo 'class="active"';
        } ?>>Home</a>
        <a <?php if ($currentpage != 'manage') {
            echo 'href="manage.php"';
        } else {
            echo 'class="active"';
        } ?>>Manage
            Student Account</a>
        <a <?php if ($currentpage != 'lost') {
            echo 'href="claimed.php"';
        } else {
            echo 'class="active"';
        } ?>>Lost &
            Found</a>
        <a <?php if ($currentpage != 'violation') {
            echo 'href="violation.php"';
        } else {
            echo 'class="active"';
        } ?>>Violation Control</a>
        <a <?php if ($currentpage != 'issued') {
            echo 'href="Issued.php"';
        } else {
            echo 'class="active"';
        } ?>>Issue
            Documentation</a>
            <a <?php if ($currentpage != 'compliance') {
                    echo 'href="compliance.php"';
                } else {
                    echo 'class="active"';
                } ?>>Student Intervention</a>
        <?php endif; ?>

    <!-- Only show "Manage Admin Account" if the role is SuperUser -->
    <?php if ($admin_role == 'ITSO'): ?>
        <a <?php if ($currentpage != 'madmin') {
            echo 'href="madmin.php"';
        } else {
            echo 'class="active"';
        } ?>>Manage Admin
            Account</a>
    <?php endif; ?>
</div>
<div class="logout">
    <a id="log-out" style="color: white">LOG OUT</a>
</div>

<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutRequestModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1B4284">
                <h1 class="modal-title" id="logoutModalLabel" style="color: #fff; font-size:40px">Log out</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style="background-color: #fff"></button>
            </div>
            <div class="modal-body text-center">
                Are you sure you want to log out?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id="surrenderYesBtn">Yes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#log-out').click(function () {
            $('#logoutModal').modal('show');
        });

        $('#surrenderYesBtn').click(function () {
            window.location.href = './php/logout.php';
        });
        $('.modal').on('shown.bs.modal', function () {
            //Make sure the modal and backdrop are siblings (changes the DOM)
            $(this).before($('.modal-backdrop'));
            //Make sure the z-index is higher than the backdrop
            $(this).css("z-index", parseInt($('.modal-backdrop').css('z-index')) + 1);
        });
    });
</script>