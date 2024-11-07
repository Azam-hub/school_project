<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "shaheen_children_academy";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    echo "Couldn't connect to database";
}

$mail_from = "legendhacker422@gmail.com";
$mail_password = "rsjjfcmnbrauwkku";

?>