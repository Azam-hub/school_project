<?php

require "../../_config.php";

$id = $_POST['id'];

$get_head_sql = "SELECT * FROM `news_events_head` WHERE `id` = '$id'";
$get_head_res = mysqli_query($conn, $get_head_sql);
$get_head_rows = mysqli_num_rows($get_head_res);

$data = mysqli_fetch_assoc($get_head_res);

$deleted = true;
$file_names_arr = explode('#|#', $data['file_name']);

foreach ($file_names_arr as $key => $value) {
    
    $file_pointer = "../../src/dynamic_src/thumbnail/".$value;

    if (!unlink($file_pointer)) {
        $deleted = false;
        break;
    }
}

if ($deleted) {

    $del_head_sql = "DELETE FROM `news_events_head` WHERE `id` = '$id'";
    $del_head_res = mysqli_query($conn, $del_head_sql);
    
    if ($del_head_res) {  
        
        $get_sql = "SELECT * FROM `new_events_description` WHERE `event_head_id` = '$id'";
        $get_res = mysqli_query($conn, $get_sql);
        $get_rows = mysqli_num_rows($get_res);
        
        if ($get_rows > 0) {
            
            for ($i=0; $i < $get_rows; $i++) { 
                $data = mysqli_fetch_assoc($get_res);
        
                $file_pointer = "../../src/dynamic_src/".$data['path'];
        
                unlink($file_pointer);
            }
            $del_desc_sql = "DELETE FROM `new_events_description` WHERE `event_head_id` = '$id'";
            $del_desc_res = mysqli_query($conn, $del_desc_sql);
            
            if ($del_desc_res) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 1;
        }
    } else {
        echo 0;
    }
}






?>