<?php

require "../../_config.php";

$search = $_POST['search'];

$get_sql = "SELECT * FROM `contact_messages` WHERE 
(`name` LIKE '%$search%' OR `phone` LIKE '%$search%' OR `email` LIKE '%$search%' OR `subject` LIKE '%$search%') 
ORDER BY `id` DESC";

$get_res = mysqli_query($conn, $get_sql);
$get_rows = mysqli_num_rows($get_res);

if ($get_rows > 0) {
    $output = "";
    for ($i=0; $i < $get_rows; $i++) {

        $data = mysqli_fetch_assoc($get_res);

        if (strlen($data['name']) > 18) {
            $name = substr($data['name'], 0, 15).'...';
        } else {
            $name = $data['name'];
        }

        // $datetime = explode('_', $data['datetime']);

        // $date = $datetime

        $output .= '
        <div class="message">
            <span class="datetime">Applied at : <b>'.$data['datetime'].'</b></span>
            <div class="message-head">
                <h1>Message from <q>'.$name.'</q></h1>
                <button class="del-btn" data-id="'.$data['id'].'">Delete</button>
            </div>
            <div class="infos">
                <span><b>Name : </b><br>
                    '.$data['name'].'
                </span>
                <span><b>Phone Number : </b><br>
                    '.$data['phone'].'
                </span>
                <span><b>Email Address : </b><br>
                    '.$data['email'].'
                </span>
                <span class="subject-span"><b>Subject : </b><br>
                    '.$data['subject'].'
                </span>
                <span class="msg-span"><b>Message : </b><br>
                    '.$data['message'].'
                </span>
            </div>
        </div>
        ';
    }
    echo $output;
} else {
    echo "No message found like <b>".$search."</b>";
}

?>