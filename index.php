<?php

require "_config.php";

$get_sql = "SELECT * FROM `information`";
$get_res = mysqli_query($conn, $get_sql);
$data = mysqli_fetch_assoc($get_res);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Akaya+Kanadaka&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">     

    <link rel="stylesheet" href="fontawesome_icon/css/all.min.css">

    <link rel="stylesheet" href="css/_utils.css">
    <link rel="stylesheet" href="css/_header-footer.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="shortcut icon" href="src/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="tiny_slider/tiny_slider.min.css">
    <title>Home - Shaheen Children Academy</title>
</head>
<body>
<div class="head-main-container">
    <?php include "_header.php"; ?>
    <section>
        <div class="first-section">
            <div class="left-side">
                <h1>Welcome to <span>Shaheen Children Academy</span></h1>

                <p><?php echo $data['first_para'] ?></p> 
                <!-- (max 60 words) -->
            </div>
            <div class="right-side">
                <img src="src/full-logo.png" alt="">
            </div>
        </div>
        <div class="second-section">
            <img src="src/success-image.jpg" alt="Pic">
        </div>
        <div class="news-events-section">
            <h1>News and Events</h1>
            <div class="events">
                <?php
                
                $get_event_head_sql = "SELECT * FROM `news_events_head` ORDER BY `id` DESC LIMIT 4";
                $get_event_head_res = mysqli_query($conn, $get_event_head_sql);
                $get_event_head_rows = mysqli_num_rows($get_event_head_res);

                if ($get_event_head_rows > 0) {
                                        
                    for ($i=0; $i < $get_event_head_rows; $i++) { 

                        $get_event_head_data = mysqli_fetch_assoc($get_event_head_res);
                        
                        $db_date = explode('-', $get_event_head_data['datetime'])[1];
                        $mod_Date = date("F d, Y", strtotime($db_date));

                        $get_event_description_sql = "SELECT * FROM `new_events_description` WHERE `event_head_id` = '".$get_event_head_data['id']."'";
                        $get_event_description_res = mysqli_query($conn, $get_event_description_sql);
                        $get_event_description_rows = mysqli_num_rows($get_event_description_res);

                        $file_names_arr = explode('#|#', $get_event_head_data['file_name']);

                        echo '<div class="event">
                                <div class="image">';

                                    if (count($file_names_arr) == 1) {
                                        
                                        echo '<img src="admin_panel/src/dynamic_src/thumbnail/'.$get_event_head_data['file_name'].'" alt="Thumbnail Pic">';
                                    } else {
                                        
                                        echo '<ul class="my-slider">';
                                                    foreach ($file_names_arr as $key => $value) {
                                                                        
                                                        echo '<li>
                                                                        <img src="admin_panel/src/dynamic_src/thumbnail/'.$value.'" alt="Thumbnail Pic">
                                                                    </li>';
                                                    }
                                        echo  '</ul>
                                        <!-- 275x183 -->';
                                    }
                                    // echo '<img src="admin_panel/src/dynamic_src/thumbnail/'.$get_event_head_data['file_name'].'" alt="Thumbnail Pic">
                                    // <!-- 275x170 -->';
                                echo '</div>
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

                                    echo '<div class="description">
                                        '.$text.'
                                    </div>
                                    <div class="btn">
                                        <a href="event.php?event_id='.$get_event_head_data['id'].'">Read More.. <i class="fa-solid fa-arrow-right"></i></a>
                                    </div>';
                            
                                } else {
                                    echo '<div class="description">
                                                    <h2 style="text-align: center;">Coming Soon!</h2>
                                                </div>';
                                }
                                echo '
                                
                            </div>';
                            
                    }

                    
                } else {
                    echo 0;
                }
                
                ?>
                <!-- <div class="event">
                    <div class="image">
                        <img src="src/students.jpg" alt="">
                    </div>
                    <div class="head">
                        <h4>Nasreen Mahmud Kasuri honoured with SDPI’s Livin...</h4>
                    </div>
                    <div class="date-time">
                        <i class="fa-regular fa-calendar-days"></i>
                        <p>September 30, 2022</p>
                    </div>
                    <div class="description">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Harum, rerum!
                    </div>
                    <div class="btn">
                        <a href="#">Read More.. <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="event">
                    <div class="image">
                        <img src="src/students.jpg" alt="">
                    </div>
                    <div class="head">
                        <h4>Nasreen Mahmud Kasuri honoured with SDPI’s Livin...</h4>
                    </div>
                    <div class="date-time">
                        <i class="fa-regular fa-calendar-days"></i>
                        <p>September 30, 2022</p>
                    </div>
                    <div class="description">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Harum, rerum!
                    </div>
                    <div class="btn">
                        <a href="#">Read More.. <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="event">
                    <div class="image">
                        <img src="src/students.jpg" alt="">
                    </div>
                    <div class="head">
                        <h4>Nasreen Mahmud Kasuri honoured with SDPI’s Livin...</h4>
                    </div>
                    <div class="date-time">
                        <i class="fa-regular fa-calendar-days"></i>
                        <p>September 30, 2022</p>
                    </div>
                    <div class="description">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Harum, rerum!
                    </div>
                    <div class="btn">
                        <a href="#">Read More.. <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="event">
                    <div class="image">
                        <img src="src/students.jpg" alt="">
                    </div>
                    <div class="head">
                        <h4>Nasreen Mahmud Kasuri honoured with SDPI’s Livin...</h4>
                    </div>
                    <div class="date-time">
                        <i class="fa-regular fa-calendar-days"></i>
                        <p>September 30, 2022</p>
                    </div>
                    <div class="description">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Harum, rerum!
                    </div>
                    <div class="btn">
                        <a href="#">Read More.. <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div> -->
            </div>
            <a href="news-and-events.php" class="see-all-link">See all Events...</a>
        </div>
    </section>
    <?php include "_footer.php"; ?>
</div>
</body>
<script src="https://kit.fontawesome.com/0d21e1944b.js" crossorigin="anonymous"></script>
<!-- Ionicon Link -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script src="tiny_slider/tiny_slider.min.js"></script>
<script>
    var sliders = Array.from(document.querySelectorAll(".my-slider"));
    console.log(sliders);
    sliders.forEach((element) => {
        console.log(element);
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
</html>