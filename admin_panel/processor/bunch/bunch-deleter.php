<?php

require "../../_config.php";

$id = $_POST['id'];

$get_sql = "SELECT * FROM `new_events_description` WHERE `id` = '$id'";
$get_res = mysqli_query($conn, $get_sql);

$data = mysqli_fetch_assoc($get_res);

$file_pointer = "../../src/dynamic_src/".$data['path'];

if (unlink($file_pointer)) {

    $del_sql = "DELETE FROM `new_events_description` WHERE `id` = '$id'";
    $del_res = mysqli_query($conn, $del_sql);

    if ($del_res) {
        echo 1;
    } else {
        echo 0;
    }

}
?>