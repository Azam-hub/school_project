<?php

require "../_config.php";

if ($_POST['action'] == 'load') {
    
    $get_event_head_sql = "SELECT * FROM `news_events_head` ORDER BY `id` DESC LIMIT 0, 20";
    $get_event_head_res = mysqli_query($conn, $get_event_head_sql);
    $get_event_head_rows = mysqli_num_rows($get_event_head_res);
    // $date = timezone_abbreviations_list()

    if ($get_event_head_rows > 0) {
        $output = "";
        $output .= '<div class="events">';

        $last_id = "";
        
        for ($i=0; $i < $get_event_head_rows; $i++) { 

            $get_event_head_data = mysqli_fetch_assoc($get_event_head_res);
            $last_id = $get_event_head_data['id'];
            
            $db_date = explode('-', $get_event_head_data['datetime'])[1];
            $mod_Date = date("F d, Y", strtotime($db_date));

            $get_event_description_sql = "SELECT * FROM `new_events_description` WHERE `event_head_id` = '".$get_event_head_data['id']."'";
            $get_event_description_res = mysqli_query($conn, $get_event_description_sql);
            $get_event_description_rows = mysqli_num_rows($get_event_description_res);

            $file_names_arr = explode('#|#', $get_event_head_data['file_name']);

            $output .= '<div class="event">
                    <div class="image">';
                        if (count($file_names_arr) == 1) {
                            
                            $output .= '<img src="admin_panel/src/dynamic_src/thumbnail/'.$get_event_head_data['file_name'].'" alt="Thumbnail Pic">';
                        } else {
                            
                            $output .= '<ul class="my-slider">';
                                        foreach ($file_names_arr as $key => $value) {
                                                            
                                            $output .= '<li>
                                                            <img src="admin_panel/src/dynamic_src/thumbnail/'.$value.'" alt="Thumbnail Pic">
                                                        </li>';
                                        }
                            $output .=  '</ul>
                            <!-- 275x183 -->';
                        }
                        
                        

                    $output .= '</div>
                    <div class="head">
                        <h3>'.$get_event_head_data['event_head'].'</h3>
                    </div>
                    <div class="date-time">
                        <i class="fa-regular fa-calendar-days"></i>
                        <p>'.$mod_Date.'</p>
                    </div>';
                    if ($get_event_description_rows > 0) {

                        $get_event_description_data = mysqli_fetch_assoc($get_event_description_res);
                        $db_full_para = $get_event_description_data['description'];
                        $text = implode(' ', array_slice(explode(' ', $db_full_para), 0, 10));

                        $output .= '<div class="description">
                            '.$text.'
                        </div>
                        <div class="btn">
                            <a href="event.php?event_id='.$get_event_head_data['id'].'">Read More.. <i class="fa-solid fa-arrow-right"></i></a>
                        </div>';
                
                    } else {
                        $output .= '<div class="description">
                                        <h2 style="text-align: center;">Coming Soon!</h2>
                                    </div>';
                    }
                    $output .= '
                    
                </div>';
            $last_id = $get_event_head_data['id'];
                
        }

        $output .= '</div>
        <script>
            var sliders = Array.from(document.querySelectorAll(".my-slider"));
            sliders.forEach((element) => {
                let slider = tns({
                    container: element,
                    autoplay : true,
                    speed : 500,
                    autoplayTimeout: 2000,
        
                    // Buttons
                    controls : false,
                    nav : false,
                    autoplayButtonOutput : false
                });
            });
        </script>
            <div class="link">
                <a href="#" id="load-more" data-last-id='.$last_id.'>Load more...</a>
            </div>';
        echo $output;
    } else {
        echo 0;
    }

} elseif ($_POST['action'] == 'search') {
    $query = mysqli_real_escape_string($conn, $_POST['query']);
    
    $get_event_head_sql = "SELECT * FROM `news_events_head` WHERE `event_head` LIKE '%$query%' ORDER BY `id` DESC";
    $get_event_head_res = mysqli_query($conn, $get_event_head_sql);
    $get_event_head_rows = mysqli_num_rows($get_event_head_res);
    
    if ($get_event_head_rows > 0) {
        $output = "";
        $output .= '<div class="events">';
        
        for ($i=0; $i < $get_event_head_rows; $i++) { 

            $get_event_head_data = mysqli_fetch_assoc($get_event_head_res);
            
            $db_date = explode('-', $get_event_head_data['datetime'])[1];
            $mod_Date = date("F d, Y", strtotime($db_date));

            $get_event_description_sql = "SELECT * FROM `new_events_description` WHERE `event_head_id` = '".$get_event_head_data['id']."'";
            $get_event_description_res = mysqli_query($conn, $get_event_description_sql);
            $get_event_description_rows = mysqli_num_rows($get_event_description_res);

            $file_names_arr = explode('#|#', $get_event_head_data['file_name']);

            $output .= '<div class="event">
                    <div class="image">';
                        if (count($file_names_arr) == 1) {
                            
                            $output .= '<img src="admin_panel/src/dynamic_src/thumbnail/'.$get_event_head_data['file_name'].'" alt="Thumbnail Pic">';
                        } else {
                            $output .= '<ul class="my-slider">';
                                            foreach ($file_names_arr as $key => $value) {
                                                                
                                                $output .= '<li>
                                                                <img src="admin_panel/src/dynamic_src/thumbnail/'.$value.'" alt="Thumbnail Pic">
                                                            </li>';
                                            }
                            $output .=  '</ul>
                            <!-- 275x183 -->';
                        }
                        
                        

                    $output .= '</div>
                    <div class="head">
                        <h3>'.$get_event_head_data['event_head'].'</h3>
                    </div>
                    <div class="date-time">
                        <i class="fa-regular fa-calendar-days"></i>
                        <p>'.$mod_Date.'</p>
                    </div>';
                    if ($get_event_description_rows > 0) {

                        $get_event_description_data = mysqli_fetch_assoc($get_event_description_res);
                        $db_full_para = $get_event_description_data['description'];
                        $text = implode(' ', array_slice(explode(' ', $db_full_para), 0, 10));

                        $output .= '<div class="description">
                            '.$text.'
                        </div>
                        <div class="btn">
                            <a href="event.php?event_id='.$get_event_head_data['id'].'">Read More.. <i class="fa-solid fa-arrow-right"></i></a>
                        </div>';
                
                    } else {
                        $output .= '<div class="description">
                                        <h2 style="text-align: center;">Coming Soon!</h2>
                                    </div>';
                    }
                    $output .= '
                    
                </div>
                ';
            $last_id = $get_event_head_data['id'];

        }

        $output .= '</div>
        <script>
            var sliders = Array.from(document.querySelectorAll(".my-slider"));
            sliders.forEach((element) => {
                let slider = tns({
                    container: element,
                    autoplay : true,
                    speed : 500,
                    autoplayTimeout: 2000,
        
                    // Buttons
                    controls : false,
                    nav : false,
                    autoplayButtonOutput : false
                });
            });
        </script>
        ';
        echo $output;
    } else {
        echo "0";
    }
    
} elseif ($_POST['action'] == 'load-more') {

    $last_id = $_POST['last_id'];
    $for_swip = $_POST['last_id'];

    $get_event_head_sql = "SELECT * FROM `news_events_head` WHERE `id` < '$last_id' ORDER BY `id` DESC LIMIT 20";
    $get_event_head_res = mysqli_query($conn, $get_event_head_sql);
    $get_event_head_rows = mysqli_num_rows($get_event_head_res);

    if ($get_event_head_rows > 0) {
        $output = "";

        // $last_id = "";
        
        for ($i=0; $i < $get_event_head_rows; $i++) { 

            $get_event_head_data = mysqli_fetch_assoc($get_event_head_res);
            
            $db_date = explode('-', $get_event_head_data['datetime'])[1];
            $mod_Date = date("F d, Y", strtotime($db_date));

            $get_event_description_sql = "SELECT * FROM `new_events_description` WHERE `event_head_id` = '".$get_event_head_data['id']."'";
            $get_event_description_res = mysqli_query($conn, $get_event_description_sql);
            $get_event_description_rows = mysqli_num_rows($get_event_description_res);

            $file_names_arr = explode('#|#', $get_event_head_data['file_name']);

            $output .= '<div class="event">
                    <div class="image">';
                        if (count($file_names_arr) == 1) {
                            
                            $output .= '<img src="admin_panel/src/dynamic_src/thumbnail/'.$get_event_head_data['file_name'].'" alt="Thumbnail Pic">';
                        } else {

                            $output .= '<ul class="my-slider-'.$for_swip.'">';
                                            foreach ($file_names_arr as $key => $value) {
                                                                
                                                $output .= '<li>
                                                                <img src="admin_panel/src/dynamic_src/thumbnail/'.$value.'" alt="Thumbnail Pic">
                                                            </li>';
                                            }
                            $output .=  '</ul>
                            <!-- 275x183 -->';
                        }
                        
                        

                    $output .= '</div>
                    <div class="head">
                        <h3>'.$get_event_head_data['event_head'].'</h3>
                    </div>
                    <div class="date-time">
                        <i class="fa-regular fa-calendar-days"></i>
                        <p>'.$mod_Date.'</p>
                    </div>';
                    if ($get_event_description_rows > 0) {

                        $get_event_description_data = mysqli_fetch_assoc($get_event_description_res);
                        $db_full_para = $get_event_description_data['description'];
                        $text = implode(' ', array_slice(explode(' ', $db_full_para), 0, 10));

                        $output .= '<div class="description">
                            '.$text.'
                        </div>
                        <div class="btn">
                            <a href="event.php?event_id='.$get_event_head_data['id'].'">Read More.. <i class="fa-solid fa-arrow-right"></i></a>
                        </div>';
                
                    } else {
                        $output .= '<div class="description">
                                        <h2 style="text-align: center;">Coming Soon!</h2>
                                    </div>';
                    }
                    $output .= '
                    
                </div>
                ';
            $last_id = $get_event_head_data['id'];

        }

        $output1 = '
        <script>
            var sliders = Array.from(document.querySelectorAll(".my-slider-'.$for_swip.'"));
            sliders.forEach((element) => {
                let slider = tns({
                    container: element,
                    autoplay : true,
                    speed : 500,
                    autoplayTimeout: 2000,
        
                    // Buttons
                    controls : false,
                    nav : false,
                    autoplayButtonOutput : false
                });
            });
        </script>
        <div class="link">
            <a href="#" id="load-more" data-last-id='.$last_id.'>Load more...</a>
        </div>
        ';
        $arr = [$output, $output1];
        echo json_encode($arr);
    } else {
        echo 0;
    }
}


?>