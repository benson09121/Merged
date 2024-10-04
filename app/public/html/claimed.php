<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['role']) && !isset($_SESSION['employee_id'])) {
    header("Location: login-page.php");
} else {
$_SESSION['currentpage'] = "lost";
include("../database/database_conn.php");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/lost.css">
    <link rel="stylesheet" href="sidenav/sidenav.css">
    <link rel="stylesheet" href="../css/general.css">
    <script src="js/screen_timeout.js"></script>

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
                <h1>Lost & Found</h1>
                <hr>
            </div>

            <div class="filter-group">
                <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search...">
                </div>
                    <div class="dropdowns">



                    <span><i class="fa-solid fa-filter"></i> Date filter</span>

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

            <div class="table-nav">
                <div class="nav-list">
                    <ul>
                        <a class="nav-class" style="border-bottom: solid 3px rgb(98, 130, 172); cursor: pointer;" data-name="claim">
                            <li>CLAIMED ITEM <span id="claimed_number">0</span></li>
                        </a>
                        <a class="nav-class" style="cursor: pointer"data-name="lost">
                            <li>SURRENDERED ITEM <span id="surrendered_number">0</span></li>
                        </a>
                        <a class="nav-class" style="cursor: pointer" data-name="summary">
                            <li>SUMMARY REPORT <span id="all_number">0</span></li>
                        </a>
                    </ul>
                </div>

                <div class="generate-btn" style="display: none;">
                    <span id="generate-report-btn"><i class="fas fa-chart-bar"></i> Generate Report</span>
                </div>

                <div class="add-btn">
                    <span><i class="fa-solid fa-plus"></i> ADD</span>
                </div>
            </div>

            <div class="body-table" data-name="claim">
                <table class="table table-hover">
                    <thead>
                        <th>ITEM</th>
                        <th>DATE LOST</th>
                        <th>DATE CLAIMED</th>
                        <th>OWNER NAME</th>
                    </thead>
                    <tbody id="body-claim">
                    </tbody>
                </table>
            </div>

            <div class="body-table" style="display: none;" data-name="lost">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ITEM</th>
                            <th>DATE LOST</th>
                            <th>Location Found</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody id="body-lost">
                    </tbody>
                </table>
            </div>

            <div class="body-table" style="display: none;" data-name="summary">
                <table class="table">
                    <thead>
                        <th>Surrendered/Claimed</th>
                        <th>ITEM</th>
                        <th>LOCATION</th>
                        <th>DATE</th>
                        <th>DESCRIPTION</th>
                        <th>IMAGE</th>
                    </thead>
                    <tbody id="body-summary">
                    </tbody>
                </table>
            </div>
            <div class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
            <!-- Modal ITEM -->
            <div id="itemModal" class="modal modal-item">
                <div class="modal-content-item">
                    <div class="modal-body">
                    <div class="modal-img">
                            <img id="claimed_img" src="../images/logo.webp" alt="">
                        </div>
                        <hr>
                        <div class="modal-details">
                            <div class="details-header">
                                <h3>Information</h3>
                            </div>
                            <div class="details-body">
                                <div class="input-wrap">
                                    <label>Owner Name</label>
                                    <p id="owner_name"></p>
                                </div>
                                <div class="input-wrap">
                                    <label>Founder Name:</label>
                                    <p id="founder_name"></p>
                                </div>
                                <div class="input-wrap">
                                    <label>Location:</label>
                                    <p id="location_found"></p>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="modal-details">
                            <div class="details-header">
                                <h3>Item Information</h3>
                            </div>
                            <div class="details-body">
                                <div class="input-wrap">
                                    <label>Item type:</label>
                                    <p id="item_type">Fibrella</p>
                                </div>
                                <div class="input-wrap">
                                    <label>Date Lost:</label>
                                    <p id="date_lost">Black</p>
                                </div>
                                <div class="input-wrap">
                                    <label>Description:</label>
                                    <p id="item_description">Black</p>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <div class="modal-buttons">
                                <span class="close" id="close">Cancel</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- LOST modal -->
            <div id="lostModal" class="modal-item">
                <div class="modal-content-item">
                    <div class="modal-body">
                        <div class="modal-img">
                            <img id="item_img" src="../images/logo.webp" alt="">
                        </div>
                        <hr>
                        <div class="modal-details">
                            <div class="details-header">
                                <h3>Information</h3>
                            </div>
                            <div class="details-body">
                                <div class="input-wrap">
                                    <label>Item Type:</label>
                                    <p id="item_type">item type</p>
                                </div>
                                <div class="input-wrap">
                                    <label for="date_lost">Date Lost:</label>
                                    <p id="date_surrender">June 5, 2024</p>
                                </div>
                                <div class="input-wrap">
                                    <label>Location Found:</label>
                                    <p id="location_found">Location</p>
                                </div>
                                <div class="input-wrap">
                                    <label>Description:</label>
                                    <p id="description">description</p>
                                </div>
                                <div class="input-wrap">
                                    <label>Founder Name:</label>
                                    <p id="founder">Red Ochavillo</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="modal-buttons">
                            <span class="close close-lost" id="close">Cancel</span>
                            <span class="claim" id="claim" data-id="">Claim</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Claim Modal -->
            <div id="claimModal" class="modal-claim">
                <div class="modal-content-claim">
                    
                        <div class="details-header-claim">
                            <h3>Owner name</h3>
                        </div>
                        <div class="modal-body-claim">
                            <div class="input-wrap">
                                <label>Owner Name:</label>
                                <input type="text" id='name_submit' required style="width: 150px;">
                            </div>
                        </div>
                        <div class="modal-footer-claim">
                            <div class="modal-buttons-claim">
                                <span class="close-claim" id="close-claim">Cancel</span>
                                <button type="submit" id="claim-submit" data-id="">Confirm</button>
                            </div>
                        </div>
                </div>
            </div>

            <div id="overlay">
                <img id="overlayImage" src="" alt="Overlay Image">
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var modal = document.getElementById("itemModal");
                    var btns = document.querySelectorAll('.item-row');
                    var span = document.getElementById("close");

                    btns.forEach(function(btn) {
                        btn.onclick = function() {
                            modal.style.display = "block";
                        };
                    });

                    span.onclick = function() {
                        modal.style.display = "none";
                    };

                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    };
                });
            </script>

            <!-- Modal ADD -->
            <div id="addModal" class="modal-add">
                <div class="modal-content-add">

                    <span class="close-add">&times;</span>

                    <div class="add-header">
                        <h1>Add Item</h1>
                    </div>

                    <div id="add-form">
                        <div class="modal-body-add">
                            <div class="modal-body1">

                                <div class="input-wrap2">
                                    <label for="student-id">Founder Name (Optional):</label>
                                    <input type="text" name="student-id">
                                </div>

                                <div class="input-wrap2">
                                    <label for="item-type">Item Type:</label>
                                    <input type="text" name="item-type">
                                </div>

                                <div class="input-wrap2">
                                    <label for="item-found">Item Found:</label>
                                    <input type="text" name="item-found">
                                </div>

                                <div class="input-wrap2">
                                    <label for="date-found">Date Found:</label>
                                    <input type="date" name="date-found">
                                </div>

                                <div class="modal-desc">
                                    <label for="description">Description:</label>
                                    <textarea name="description" id=""></textarea>
                                </div>

                            </div>

                            <div class="modal-body2">
                                <div class="image-container" id="images"></div>
                                <div class="upload-button">
                                    <input type="file" id="file-input" accept="image/png, image/jpeg">
                                    <label for="file-input"><i class="fas fa-upload"></i> Upload</label>
                                </div>
                            </div>

                        </div>
                        <p id="all-error" style="display: none;">Please fill up all the necessary fields to submit</p>
                        <div class="modal-form-btn">
                            <button type="submit" id="add-submit">SUBMIT</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <script>
            var from = '';
            var to = '';

         $(document).ready(function(){
            $('.nav-class').click(function(){
               $('.nav-class').css('border-bottom', 'none');
               $(this).css('border-bottom', 'solid 3px rgb(98, 130, 172)');
                let nav_name = $(this).attr('data-name');
               $('.body-table').each(function(){
                     if($(this).attr('data-name') === nav_name){
                          $(this).css('display', 'block');
                          if(nav_name === 'summary'){
                              $('.generate-btn').css('display', 'block');
                          }
                          else{
                              $('.generate-btn').css('display', 'none');
                          }
                          if(nav_name === 'lost' || nav_name === 'claim'){
                              $('.add-btn').css('display', 'block');
                          }
                          else{
                              $('.add-btn').css('display', 'none');
                          }
                     }
                     else{
                          $(this).css('display', 'none');
                     }
               })
            })
            $('#body-summary').on('click', '.image-click', function(){
                let src = $(this).attr('src');
                $('#overlayImage').attr('src', src);
                $('#overlay').css('display', 'block');
            })
            $('#overlay').click(function(){
                $(this).css('display', 'none');
            })
            $('#body-lost').on('click', '.lost-items', function(){
                let id = $(this).attr('data-id');
                let name = $(this).attr('data-name');
                let date_found = $(this).attr('data-date-found');
                let location_found = $(this).attr('date-location-found');
                let description = $(this).attr('data-description');
                let founder = $(this).attr('data-founder');
                if(founder === ''){
                    founder = 'Anonymous';
                }
                let image = $(this).attr('data-img');
                $('#lostModal').find('#claim').attr('data-id', id);
                $('#lostModal').find('#item_type').text(name);
                $('#lostModal').find('#date_surrender').text(date_found);
                $('#lostModal').find('#location_found').text(location_found);
                $('#lostModal').find('#description').text(description);
                $('#lostModal').find('#founder').text(founder);
                $('#lostModal').css('display', 'block');
                $('#item_img').attr('src', './php/new_items/'+image);
            })

            $('#body-claim').on('click', '.claim-items', function(){
                owner = $(this).data('name');
                founder = $(this).data('founder');
                if (founder === ''){
                    founder = 'Anonymous';
                }
                date_found = $(this).data('date-found');
                location_found = $(this).data('location-found');
                description = $(this).data('description');
                image = $(this).data('img');
                $('#itemModal').find('#owner_name').text(owner);
                $('#itemModal').find('#founder_name').text(founder);
                $('#itemModal').find('#location_found').text(location_found);
                $('#itemModal').find('#item_type').text(owner);
                $('#itemModal').find('#date_lost').text(date_found);
                $('#itemModal').find('#item_description').text(description);
                $('#claimed_img').attr('src', './php/new_items/'+image);
                $('#itemModal').css('display', 'block');
            })

            $('#close-claim').click(function(){
                $('#claimModal').css('display', 'none');
            })
            
            $('.close-lost').click(function(){
                $('#lostModal').css('display', 'none');
            })  

            $('#claim-submit').click(function (){
                let name = $('#name_submit').val();
                if(name === ''){
                    return;
                }
                let id = $((this)).attr('data-id');
                $.ajax({
                    url: 'php/claim_item.php',
                    type: 'POST',
                    data: {
                        claimed_by: name,
                        item_no: id,
                        released_by: <?php echo $_SESSION['employee_id'] ?>
                    },
                    success: function(response){
                        if(response === 'success'){
                            $('#name_submit').val('');
                            $('#claimModal').css('display', 'none');
                            $('#lostModal').css('display', 'none');
                        }
                    }
                })
            })

            $('#claim').click(function(){
                let id = $(this).attr('data-id');
                $('#claimModal').find('#claim-submit').attr('data-id', id);
                $('#claimModal').css('display', 'block');
            })

            $('.add-btn').click(function(){
                $('#addModal').css('display', 'block');
            })

            $('#file-input').on('change', function(){
                let file = $(this)[0].files[0];
                let reader = new FileReader();
                reader.onload = function(e){
                    $('#images').html(`<img src="${e.target.result}" alt="">`)
                }
                reader.readAsDataURL(file);
            })
            $('#add-submit').click(function(){
                let student_id = $('input[name="student-id"]').val();
                let item_type = $('input[name="item-type"]').val();
                let item_found = $('input[name="item-found"]').val();
                let date_found = $('input[name="date-found"]').val();
                let description = $('textarea[name="description"]').val();
                let imageFile = $('#file-input')[0].files[0];
                //Change the date found into mysql date format
                let date = new Date(date_found);
                let year = date.getFullYear();
                let month = date.getMonth() + 1;
                let day = date.getDate();
                date_found = `${year}-${month}-${day}`;
                if( item_type === '' || item_found === '' || description === '' || imageFile === undefined){
                    $('#all-error').css('display', 'block');
                }
                else{
                    let formData = new FormData();
                    formData.append('image', imageFile);
                    formData.append('founder_name', student_id);
                    formData.append('item_type', item_type);
                    formData.append('date_found', date_found);
                    formData.append('item_found', item_found);
                    formData.append('description', description);
                $.ajax({
                    url: 'php/add_item_lost.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        console.log(response);
                        if(response === 'success'){
                            $('#addModal').css('display', 'none');
                            $('input[name="student-id"]').val('');
                            $('input[name="item-type"]').val('');
                            $('input[name="item-found"]').val('');
                            $('textarea[name="description"]').val('');
                            $('#images').html('');
                            $('#all-error').css('display', 'none'); 
                        }
                    }
                })
                }
            });

            $('.close-add').click(function(){
                $('#addModal').css('display', 'none');
            })

            setInterval(function(){
                $.ajax({
                    url: 'php/get_claimed.php',
                    type: 'POST',
                    data: {
                        from: from,
                        to: to
                    },
                    success: function(response){
                        console.log(response);
                     data = JSON.parse(response);
                     lost = data.lost_items;
                     claimed = data.claimed_items;
                     summary = data.summary;
                     number_lost = data.number_lost_items;
                     number_claimed = data.number_claimed_items;
                     number_all = data.number_all_items;
                        $('#body-claim').html('');
                        $('#body-lost').html('');
                        $('#body-summary').html('');

                        if(lost === 'No data'){
                            $('#body-lost').append('<tr><td colspan="4">No data</td></tr>');
                        }
                        else{
                            lost.forEach(function(item){
                            $('#body-lost').append('<tr class="lost-items" style="cursor: pointer;" data-id="'+item.item_no+'" data-name="'+item.name+'" data-date-found="'+item.date_found+'" date-location-found="'+item.location_found+'" data-description="'+item.description+'" data-founder="'+item.founder+'" data-img="'+item.image+'"><td>'+item.name+'</td><td>'+item.date_found+'</td><td>'+item.location_found+'</td><td>'+item.description+'</td></tr>')
                        })
                        }
                        if(claimed === 'No data'){
                            $('#body-claim').append('<tr><td colspan="4">No data</td></tr>');
                        }
                        else{
                            claimed.forEach(function(item){
                            $('#body-claim').append('<tr class="claim-items" style="cursor: pointer;" data-id="'+item.item_no+'" data-name="'+item.name+'" data-date-found="'+item.date_found+'" date-location-found="'+item.location_found+'" data-description="'+item.description+'" data-founder="'+item.founder+'" data-img="'+item.image+'"><td>'+item.name+'</td><td>'+item.date_found+'</td><td>'+item.date_claimed+'</td><td>'+item.claimed_by+'</td></tr>')
                        })
                        }
                        if(summary === 'No data'){
                            $('#body-summary').append('<tr><td colspan="6">No data</td></tr>');
                        }
                        else{
                        summary.forEach(function(item){
                            $('#body-summary').append(`
                            <tr>
                                <td>${item.claimed_by === null ? 'Surrendered' : 'Claimed'}</td>
                                <td>${item.name}</td>
                                <td>${item.location_found}</td>
                                <td>${item.date_found}</td>
                                <td>${item.description}</td>
                                <td><img src="./php/new_items/${item.image}" alt="" class="image-click"></td>`)
                        })
                    }
                        $('#claimed_number').text(number_claimed);
                        $('#surrendered_number').text(number_lost);
                        $('#all_number').text(number_all);  
                    }
                })
            }, 1000)
              $('#generate-report-btn').click(function(){
                window.location.href = 'php/generate_lost_found_report.php';
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

         })
        </script>




        </div>

    </section>

    <script src="../javascript/profile.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>
<?php
}