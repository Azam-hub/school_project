<?php

require '../../_config.php';

$id = $_POST['id'];

$del_sql = "DELETE FROM `contact_messages` WHERE `id`='$id'";
$del_res = mysqli_query($conn, $del_sql);

if ($del_res) {
    echo 0;
}


?>