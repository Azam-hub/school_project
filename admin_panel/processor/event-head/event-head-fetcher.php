<?php

require "../../_config.php";

if ($_POST['action'] == "on-load") {
    $get_sql = "SELECT * FROM `news_events_head` ORDER BY `id` DESC";
    $get_res = mysqli_query($conn, $get_sql);
    $get_rows = mysqli_num_rows($get_res);

    if ($get_rows > 0) {
        $output = "";

        for ($i=0; $i < $get_rows; $i++) { 

            $data = mysqli_fetch_assoc($get_res);

            $mod_date = explode('-', $data['datetime'])[1];

            $file_names_arr = explode('#|#', $data['file_name']);

            $output .= '<div class="event-head">
                            <div class="up">
                                <p class="date">Added on: '.$mod_date.'</p>
                                <a href="add-bunch.php?event-head-id='.$data['id'].'">
                                    <i class="plus fa-solid fa-plus"></i>
                                </a>
                                <i class="edit-head fa-regular fa-pen-to-square" data-id="'.$data['id'].'"></i>
                                <i class="delete-head fa-regular fa-trash-can" data-id="'.$data['id'].'"></i>
                                ';
                                

                                $get_ul_sql = "SELECT * FROM `new_events_description` WHERE `event_head_id` = '".$data['id']."'";
                                $get_ul_res = mysqli_query($conn, $get_ul_sql);
                                $get_ul_rows = mysqli_num_rows($get_ul_res);

                                if ($get_ul_rows > 0) {

                                    $output .= '<i id="angle" class="angle fa-solid fa-angle-down"></i>
                                    <ul id="ul">';

                                    for ($j=0; $j < $get_ul_rows; $j++) { 
                                        $ul_data = mysqli_fetch_assoc($get_ul_res);

                                        $output .= '<li>
                                                        <a href="edit-bunch.php?bunch-id='.$ul_data['id'].'">
                                                            <i class="edit fa-regular fa-pen-to-square"></i>
                                                        </a>
                                                        <i data-id="'.$ul_data['id'].'" class="delete fa-regular fa-trash-can"></i>
                                                        '.$ul_data['head'].'
                                                    </li>';
                                    }

                                    $output .= '</ul>';
                                } else {
                                    $output .= '<div class="not-div"></div>';
                                }
                            $output .= '
                            </div>
                            <div class="down">
                                <div class="images">';
                                    foreach ($file_names_arr as $key => $value) {
                                        
                                        $output .= '<img src="src/dynamic_src/thumbnail/'.$value.'" alt="thumbnail_pic">';
                                    }

                                $output .= '</div>
                                <h3>'.$data['event_head'].'</h3>
                            </div>
                        </div>';
        }
        echo $output;
    } else {
        echo 0;
    }
    
} elseif ($_POST['action'] == "on-search") {

    $search_string = mysqli_real_escape_string($conn, $_POST['search_string']);

    $get_sql = "SELECT * FROM `news_events_head` WHERE `event_head` LIKE '%$search_string%' ORDER BY `id` DESC";
    $get_res = mysqli_query($conn, $get_sql);
    $get_rows = mysqli_num_rows($get_res);

    if ($get_rows > 0) {
        $output = "";

        for ($i=0; $i < $get_rows; $i++) { 

            $data = mysqli_fetch_assoc($get_res);

            $mod_date = explode('-', $data['datetime'])[1];

            $output .= '<div class="event-head">
                            <div class="up">
                                <p class="date">Added on: '.$mod_date.'</p>
                                <a href="add-bunch.php?event-head-id='.$data['id'].'">
                                    <i class="plus fa-solid fa-plus"></i>
                                </a>
                                <i class="edit-head fa-regular fa-pen-to-square" data-id="'.$data['id'].'"></i>
                                <i class="delete-head fa-regular fa-trash-can" data-id="'.$data['id'].'"></i>
                                ';
                                

                                $get_ul_sql = "SELECT * FROM `new_events_description` WHERE `event_head_id` = '".$data['id']."'";
                                $get_ul_res = mysqli_query($conn, $get_ul_sql);
                                $get_ul_rows = mysqli_num_rows($get_ul_res);

                                if ($get_ul_rows > 0) {

                                    $output .= '<i id="angle" class="angle fa-solid fa-angle-down"></i>
                                    <ul id="ul">';

                                    for ($j=0; $j < $get_ul_rows; $j++) { 
                                        $ul_data = mysqli_fetch_assoc($get_ul_res);

                                        $output .= '<li>
                                                        <a href="edit-bunch.php?bunch-id='.$ul_data['id'].'">
                                                            <i class="edit fa-regular fa-pen-to-square"></i>
                                                        </a>
                                                        <i data-id="'.$ul_data['id'].'" class="delete fa-regular fa-trash-can"></i>
                                                        '.$ul_data['head'].'
                                                    </li>';
                                    }

                                    $output .= '</ul>';
                                } else {
                                    $output .= '<div class="not-div"></div>';
                                }
                            $output .= '
                            </div>
                            <div class="down">
                                <img src="src/dynamic_src/thumbnail/'.$data['file_name'].'" alt="thumbnail_pic">
                                <h3>'.$data['event_head'].'</h3>
                            </div>
                        </div>';
        }
        echo $output;
    } else {
        echo 0;
    }
    
}


?>