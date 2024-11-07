<?php

require "../../_config.php";
date_default_timezone_set("Asia/Karachi");
$datetime = date("H:i - d M y");
$for_name_datetime = date("H_i_s-d_M_y");

if ($_POST['head'] != '' && $_POST['description'] != '') {
    
    $bunch_id = mysqli_real_escape_string($conn, $_POST['bunch-id']);
    $head = mysqli_real_escape_string($conn, $_POST['head']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $file = $_FILES['file'];

    if ($_FILES['file']['name'] != '') {

        $video_img_name = $_POST['video-img-name'];
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

            $file_pointer = "../../src/dynamic_src/".$video_img_name;
  
            if (unlink($file_pointer)) {

                if (strpos($head, '\\') || strpos($head, '/')) {
                    $file_name = '@'.$for_name_datetime.'.'.$extension;

                } else {
                    $file_name = $head.'@'.$for_name_datetime.'.'.$extension;

                }
                
                $path = '../../src/dynamic_src/'.$file_name;
        
                if (move_uploaded_file($file_tmp_name, $path)) {
                    
                    $edit_sql = "UPDATE `new_events_description` SET `path` = '$file_name', `head` = '$head', 
                    `description` = '$description', `datetime` = '$datetime' 
                    WHERE `id` = '$bunch_id'";
                    $edit_res = mysqli_query($conn, $edit_sql);
        
                    if ($edit_res) {
                        echo 1;
                    } else {
                        echo 0;
                    }
                    
                }
            } else {
                echo 0;
            }
    
        }
        
    } else {
        $edit_sql = "UPDATE `new_events_description` SET `head` = '$head', 
        `description` = '$description', `datetime` = '$datetime' WHERE `id` = '$bunch_id'";
        $edit_res = mysqli_query($conn, $edit_sql);

        if ($edit_res) {
            echo 1;
        } else {
            echo 0;
        }
    }
    



} else {
    echo 'not-set';
}



?>