<?php

require "../_config.php";

$id = $_POST['id'];

if ($_POST['action'] == "del") {

    $del_sql = "DELETE FROM `email` WHERE `id`='$id'";
    $del_res = mysqli_query($conn, $del_sql);

    if ($del_res) {
        echo 1;
    } else {
        echo 0;
    }

}

?>