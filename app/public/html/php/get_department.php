<?php
include '../database/database_conn.php';

$sql = "SELECT * FROM tbl_school_info";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
          <li><a class="dropdown-item" href="#" data-course-id="<?php echo $row['school_id']; ?>"        
          ><?php echo $row['school_name']; ?></a></li>
         <?php
        }
    }else{
        
    }

    ?>