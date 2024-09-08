<?php

$sql = 'SELECT * FROM tbl_school_info;';

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)){

        ?>
                    <div class="dept dept1">
         <div class="card">
        <div class="card-header">-</div>
        <div class="card-body">
            <h5 class="card-title"><?php echo $row['school_name']; ?></h5>
            <p class="card-text"><?php echo $row['description']; ?></p>
        </div>
                    </div>
                    </div>

<?php
    }
} else{
    echo 'No Data Found.';
}
mysqli_close($conn);
?>