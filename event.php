<?php

require "_config.php";

if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
} else {
    header("location: news-and-events-fetcher.php");
}

$get_event_head_sql = "SELECT * FROM `news_events_head` WHERE `id` = '$event_id'";
$get_event_head_res = mysqli_query($conn, $get_event_head_sql);
$get_event_head_rows = mysqli_num_rows($get_event_head_res);
$get_event_head_data = mysqli_fetch_assoc($get_event_head_res);

if ($get_event_head_rows > 0) {
    $title = $get_event_head_data['event_head'];
} else {
    $title = 'Coming Soon!';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    
    <link rel="stylesheet" href="fontawesome_icon/css/all.min.css">

    <link rel="stylesheet" href="css/_utils.css">
    <link rel="stylesheet" href="css/_header-footer.css">
    <link rel="stylesheet" href="css/event.css">
    <link rel="shortcut icon" href="src/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="tiny_slider/tiny_slider.min.css">
    <title><?php echo $title; ?> - Shaheen Children Academy</title>
</head>
<body>
<div class="head-main-container">
    <?php include "_header.php"; ?>
    <!-- <?php echo $msg; ?> -->
    <section>
        <div class="container">
            <div class="left-side">
                <?php

                $get_description_sql = "SELECT * FROM `new_events_description` WHERE `event_head_id` = '$event_id'";
                $get_description_res = mysqli_query($conn, $get_description_sql);
                $get_description_rows = mysqli_num_rows($get_description_res);

                if ($get_description_rows > 0) {

                    $get_event_head_sql = "SELECT * FROM `news_events_head` WHERE `id` = '$event_id'";
                    $get_event_head_res = mysqli_query($conn, $get_event_head_sql);
                    $get_event_head_data = mysqli_fetch_assoc($get_event_head_res);
                    echo '<h1 class="main-head">'.$get_event_head_data['event_head'].'</h1>';

                    for ($i=0; $i < $get_description_rows; $i++) { 
                        $get_description_data = mysqli_fetch_assoc($get_description_res);

                        $filename = $get_description_data['path'];
                        $pos = strrpos($filename, '.');
                        $prefix = substr($filename, 0, $pos);
                        $extension = substr($filename, $pos + 1);

                        $img_formats = ['png', 'jpg', 'jpeg', 'gif', 'tiff'];

                        if (in_array($extension, $img_formats)) {
                            
                            echo '<div class="bunch">
                                    <img src="admin_panel/src/dynamic_src/'.$get_description_data['path'].'">
                                    <h2>'.$get_description_data['head'].'</h2>
                                    <p>'.$get_description_data['description'].'</p>
                                </div>';

                        } else {
                            echo '<div class="bunch">
                                    <video src="admin_panel/src/dynamic_src/'.$get_description_data['path'].'" controls></video>
                                    <h2>'.$get_description_data['head'].'</h2>
                                    <p>'.$get_description_data['description'].'</p>
                                </div>';
                        }
                        

                    }
                } else {
                    echo '<h2>Coming Soon!</h2>';
                }
                
                ?>
                <!-- <h1 class="main-head">14th August Celeberation</h1>
                <div class="bunch">
                    <video src="admin_panel/src/dynamic_src/New Tab - Google Chrome 2022-10-04 23-26-41.mp4" controls></video>
                    <h2>Lorem, ipsum dolor.</h2>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Incidunt aut nobis provident dolorum, cumque praesentium nesciunt, itaque, ipsa quibusdam debitis in vero nemo eum eius. Recusandae molestias blanditiis vero adipisci, necessitatibus quia eveniet. Fugiat, exercitationem ea dolor saepe odio doloribus, vel aperiam omnis veritatis, nam magni quia? Earum nesciunt laudantium, pariatur eius possimus placeat porro reprehenderit optio, et repellendus nulla voluptate natus minus, inventore rerum est voluptatem? Dolores quae voluptatum quod iure. Deserunt velit qui ullam repellendus voluptates impedit ipsum deleniti optio sunt odit fugit, officiis eius, fugiat commodi! Eligendi, quae. Nemo est dignissimos, a rem ea praesentium vel enim temporibus maxime repellat eligendi accusamus facere id fuga, aut aliquam quas ipsa consectetur molestiae consequuntur necessitatibus, tempore officia eum veritatis. Inventore earum magni dolore assumenda asperiores tenetur, temporibus odit, reprehenderit accusantium doloremque eligendi atque fuga iste perferendis modi optio quis.</p>
                </div>
                <div class="bunch">
                    <img src="src/sample.jpg">
                    <h2>Lorem, ipsum dolor.</h2>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facere ullam laborum mollitia praesentium rem, molestias atque neque odit quos, quaerat laudantium nemo debitis voluptas. Provident maxime, qui eos quo perferendis assumenda itaque illo sit quae voluptatum. Amet, dignissimos est aspernatur, earum dicta ratione at eos cumque, numquam cum ducimus quod aut laborum vel voluptate tempora. Commodi magnam excepturi saepe harum dolorem. Quasi asperiores velit provident quia! Officia provident vero ducimus laudantium saepe minus dolore excepturi, itaque reiciendis in, alias sapiente!</p>
                </div> -->
                
            </div>
            <div class="right-side">
                <h3>Other News and Events</h3>
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
                        275x183
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
                </div> -->
            </div>
        </div>
    </section>
    <?php include "_footer.php"; ?>
</div>
</body>
<!-- Fontawesome Link -->
<script src="https://kit.fontawesome.com/0d21e1944b.js" crossorigin="anonymous"></script>
<!-- Ionicon Link -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<!-- jQuery Link -->
<script src="jquery/jquery-3.6.1.min.js"></script>

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