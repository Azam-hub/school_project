<?php

require "../../_config.php";
date_default_timezone_set("Asia/Karachi");
$datetime = date("H:i - d M y");
$for_name_datetime = date("H_i_s-d_M_y");

if ($_POST['head'] != '' && $_POST['description'] != '' && $_FILES['file']['name'] != '') {
    
    $event_head_id = mysqli_real_escape_string($conn, $_POST['event-head-id']);
    $head = mysqli_real_escape_string($conn, $_POST['head']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $file = $_FILES['file'];

    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_type = $file['type'];
    $file_size = $file['size'];

    $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $formats = [
        'mp4', 'mov', 'avi', 'flv', 'mkv', 'wmv', 'png', 'jpg', 'jpeg', 'gif', 'tiff'
    ];

    if (!in_array($extension, $formats)) {
        echo "format-not-supported";
    } elseif ($file_size > 1073741824) {
        echo 'file-size-large';
    } else {

        if (strpos($head, '\\') || strpos($head, '/')) {
            $file_name = '@'.$for_name_datetime.'.'.$extension;

        } else {
            $file_name = $head.'@'.$for_name_datetime.'.'.$extension;

        }
        
        $path = '../../src/dynamic_src/'.$file_name;

        if (move_uploaded_file($file_tmp_name, $path)) {
            
            $insert_sql = "INSERT INTO `new_events_description` (`path`, `head`, `description`, `event_head_id`, `datetime`) 
            VALUES ('$file_name', '$head', '$description', '$event_head_id', '$datetime')";
            $insert_res = mysqli_query($conn, $insert_sql);

            if ($insert_res) {
                echo 1;
            } else {
                echo 0;
            }
            
        }
    }


} else {
    echo 'not-set';
}



?>