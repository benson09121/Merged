<?php

include '../database/database_conn.php';

$school = $_POST['school'];

$sql = "SELECT tann.announcement_id, tann.title, tadmin.username as sender, tann.message, tann.image, tann.recipients, tann.date_sent
            FROM sql12729827.tbl_announcement as tann
            INNER JOIN sql12729827.tbl_admin_info as tadmin
            ON tann.employee_id = tadmin.employee_id
            WHERE recipients = '" . $school . "' || recipients = 'ALL'
            ORDER BY announcement_id DESC";

$result = mysqli_query($conn, $sql);
$final_data = [];
if (mysqli_num_rows($result) >= 1) {

    $index = 0;

    while ($row = mysqli_fetch_assoc($result)) {

        $image_name = $row["image"];
        $base64 = '';


        if ($image_name != null) {
            $imagedata = file_get_contents("../image_announcement/$image_name");
            $base64 = base64_encode($imagedata);
        }

        $final_data[$index] = [
            'announcement_id' => $row["announcement_id"],
            'title' => $row["title"],
            'sender' => $row["sender"],
            'message' => $row["message"],
            'image' => $base64,
            'recipients' => $row["recipients"],
            'date_sent' => $row["date_sent"],
        ];

        $index++;
    }
}

header('Content-type: application/json; charset=utf-8');
echo '{"results": ' . json_encode($final_data) . "}";

mysqli_close($conn);
?>