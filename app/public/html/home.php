<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['role']) && !isset($_SESSION['employee_id'])) {
    header("Location: login-page.php");
} else {
$_SESSION['currentpage'] = "home";
include("../database/database_conn.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/DOMS_logo.png" type="image/x-icon">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="sidenav/sidenav.css">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/viob.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/screen_timeout.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" 
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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

            <div class="title-page">
                <h1>Dashboard</h1>
                <hr>
            </div>

            <div class="body-header">
                <h3>DEPARTMENT</h3>
                <span><i class="fa-solid fa-filter"></i> Date filter</span>
            </div>

<button type="button" id="announcement_button" class="all-announcement-button">ANNOUNCEMENT</button>

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
                        <button>APPLY FILTER</button>
                    </div>
                </div>
            </div>

            <script>
                var modaldate = document.getElementById("dateModal");
                var btndate = document.querySelector(".body-header span");
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

            <div class="body-nav">
                <?php
                include('php/home-school.php');
                ?>
            </div>

            <hr>

            <div class="department-info">
                <?php include('php/home-content-populate.php'); ?>
            </div>

            <hr>

            <div class="department-info2">

                <div class="department-charts">
                    <div class="chart-column doughnut-chart">
                        <h3>Minor Offense</h3>
                        <canvas id="doughnut-chart1"></canvas>
                    </div>

                    <div class="chart-column doughnut-chart">
                        <h3>Major Offense</h3>
                        <canvas id="doughnut-chart2"></canvas>
                    </div>
                </div>


            </div>
            <!-- Modal Announcement -->
         

        </div>
                <!-- Modal Announcement  -->
        <div class="modal fade " id="announcement_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Announcement</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <!-- First Column -->
            <div class="col-md-6">
              <h5>Add Announcement</h5>
              <div class="mb-3">
      <label for="Select" class="form-label">Department</label>
      <select id="Select" class="form-select">
        <option selected>Select Department</option>
        <option value="All">All Department</option>

      </select>
    </div>  
              <div class="mb-3">
    <label for="announcement_title" class="form-label">Announcement Title</label>
    <input type="text" class="form-control" id="announcement_title" placeholder="Enter title" maxlength="70">
    <small>0/70</small>
  </div>
  <div class="mb-3">
    <label for="announcement_message">Announcement Message</label>
    <textarea class="form-control" id="announcement_message" placeholder="Enter message" rows="5" style="resize: none;" maxlength="1000"></textarea>
    <small>0/1000</small>
  </div>

            </div>
            <!-- Second Column -->
            <div class="col-md-6">
              <h5>Announcement List</h5>
              <div class="list-group overflow-auto" id="announcement-list" style="max-height: 400px; max-width: auto;">
  
</div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="add_announcement"class="btn btn-primary">ADD</button>
      </div>
    </div>
  </div>
</div>
    </section>

</body>
<script>
                // Doughnut Chart1
                var doughnutChartCanvas = document.getElementById('doughnut-chart1');
                var doughnutChart = new Chart(doughnutChartCanvas, {
                    type: 'doughnut',
                    data: {
                        labels: ['No ID', 'Improper Uniform', 'Cheating'],
                        datasets: [{
                            label: 'Doughnut Chart',
                            data: [30, 30, 40],
                            backgroundColor: ['#e86c6c', '#18c0d3', '#e8d56c'],
                            borderWidth: 1
                        }]
                    }
                });

                // Doughnut Chart2
                var doughnutChartCanvas = document.getElementById('doughnut-chart2');
                var doughnutChart = new Chart(doughnutChartCanvas, {
                    type: 'doughnut',
                    data: {
                        labels: ['No ID', 'Improper Uniform', 'Cheating'],
                        datasets: [{
                            label: 'Doughnut Chart',
                            data: [30, 30, 40],
                            backgroundColor: ['#e86c6c', '#18c0d3', '#e8d56c'],
                            borderWidth: 1
                        }]
                    }
                });
                $(document).ready(function(){

                    $.ajax({
                    typ: "GET",
                    url: "php/announcement-content.php",
                    success: function(response){

                        let JsonData = JSON.parse(response);
                        JsonData.forEach(element=>{
                            $('#Select').append(`<option value="${element.school_name}">${element.school_name}</option>`);
                        });
                    }
                 });

                 setInterval(function(){
                    $.ajax({
                    type: "GET",
                    url: "php/announcement-list.php",
                    success: function(response){
                        $('#announcement-list').empty();
                        let JsonData = JSON.parse(response);
                        JsonData.forEach(element=>{
                            if(element.message.length > 40){
                                element.message = element.message.substring(0,40) + '...';
                            }
                            $('#announcement-list').append(`<a href="#" class="list-group-item list-group-item-action" aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                              <h5 class="mb-1">${element.title}</h5>
                              <small>${element.date_sent}</small>
                            </div>
                            <p class="mb-1">${element.message}</p>
                            <small>${element.recipients}</small>
                          </a>`);
                        });
                 }
                 });

                 }, 1000);
                    $('#add_announcement').on('click', function(){
                        let title = $('#announcement_title').val();
                        let message = $('#announcement_message').val();
                        let department = $('#Select').val();
                        $.ajax({
                            type: "POST",
                            url: "php/add-announcement.php",
                            data: { title: title, 
                                    message: message, 
                                    department: department,
                                    employee_id: <?php echo $_SESSION['employee_id']; ?>
                                },
                            success: function(response){
                                console.log(response);
                                if(response === 'success'){
                                title = $('#announcement_title').val('');
                                message = $('#announcement_message').val('');
                                department = $('#Select').selectedIndex = 0;
                                $('#announcement_modal').modal('hide');
                                }

                            }
                        })
                    })

                    $('#announcement_button').on('click', function(){
                        $('#announcement_modal').modal('show');
                    })

                    $('#announcement_message').on('keyup', function(){
                       let length = $(this).val().length;
                          $(this).next().text(`${length}/1000`);
                    })
                    $('#announcement_message').on('change', function(){
                        let length = $(this).val().length;
                          $(this).next().text(`${length}/1000`);
                    })
                    $('#announcement_title').on('keyup', function(){
                        let length = $(this).val().length;
                          $(this).next().text(`${length}/70`);
                    })
                    $('#announcement_title').on('change', function(){
                        let length = $(this).val().length;
                          $(this).next().text(`${length}/70`);
                    })

                    $('.school-button').on('click', function(event){
                        $('.school-button').attr('style', '');
                        $(this).attr('style', 'background-color: var(--div-primary-color); color: white;');
                        let id = $(this).attr('data-id');
                        $.ajax({
                            type: "POST",
                            url: "php/home-content.php",
                            data: {id: id},
                            success:function(response){
                                $('.department-info').empty();
                                let JsonData = JSON.parse(response);
                                console.log(JsonData);
                                if(id != 0){
                                $.each(JsonData, function(index,value){
                                    $('.department-info').append(`
                                    <div class="dept dept1">
         <div class="card">
        <div class="card-header">-</div>
        <div class="card-body">

            <p class="card-text">${value.description} Dept.</p>
        </div>
                    </div>
                    </div>
                            `);
                                })
                            }else{
                                $.each(JsonData, function(index,value){
                                    $('.department-info').append(`
                                    <div class="dept dept1">
         <div class="card">
        <div class="card-header">-</div>
        <div class="card-body">
            <h5 class="card-title">${value.school_name}</h5>
            <p class="card-text">${value.description}</p>
        </div>
                    </div>
                    </div>
                    `)
                                })
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
<?php
}



?>