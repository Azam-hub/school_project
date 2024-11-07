<?php

require "_config.php";

$get_sql = "SELECT * FROM `information`";
$get_res = mysqli_query($conn, $get_sql);
$data = mysqli_fetch_assoc($get_res);

$current_page = (basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']));
// echo $current_page;
// $current_page = $_SERVER['REQUEST_URI'];
// $arr = explode('/', $current_page);
// echo $arr[2];

// if ($current_page == "index.php" || $current_page == '/') {
//     echo 'active-mobile-tab';
// }

?>

<header>
    <div class="black"></div>
    <div class="top-line">
        <div class="info-container">
            <div class="phone">
                <i class="fa-solid fa-phone"></i>
                <a href="tel:<?php echo $data['phone_number'] ?>"><?php echo $data['phone_number'] ?></a>
            </div>
            <div class="mail">
                <i class="fa-solid fa-envelope"></i>
                <a href="mailto:<?php echo $data['gmail_id'] ?>"><?php echo $data['gmail_id'] ?></a>
            </div>
        </div>
        <div class="icons">
            <a target="_blank" href="<?php echo $data['facebook_url'] ?>"><i class="fa-brands fa-facebook-f"></i></a>
            <a target="_blank" href="<?php echo $data['insta_url'] ?>"><i class="fa-brands fa-instagram"></i></a>
        </div>
    </div>
    <nav>
        <div class="logo-side">
            <a href="index.php">
                <img src="src/logo.png" alt="Logo">
                <h1>Shaheen Children Academy</h1>
            </a>
        </div>
        
        <div class="links-side">
            <ul>
                <li>
                    <a class="<?php if ($current_page == "index.php") {echo 'active-tab';} ?>" href="index.php">
                        Home
                    </a>
                </li>
                <li>
                    <a class="<?php if ($current_page == "news-and-events.php") {echo 'active-tab';} ?>" href="news-and-events.php">
                        News and Events
                    </a>
                </li>
                <li>
                    <a class="<?php if ($current_page == "apply-for-job.php") {echo 'active-tab';} ?>" href="apply-for-job.php">
                        Apply for Job
                    </a>
                </li>
                <li>
                    <a class="<?php if ($current_page == "about-us.php") {echo 'active-tab';} ?>" href="about-us.php">
                        About Us
                    </a>
                </li>
                <li>
                    <a class="<?php if ($current_page == "contact-us.php") {echo 'active-tab';} ?>" href="contact-us.php">
                        Contact Us
                    </a>
                </li>
            </ul>
        </div>
        <div class="upper-menu">
            <div class="menu">
                <!-- <div class="inner-menu"> -->
                    <span class="lines first-line"></span>
                    <span class="lines second-line"></span>
                    <span class="lines third-line"></span>
                <!-- </div> -->
            </div>
        </div>
        
    </nav>
    <div class="other-links-side">
        <ul>
            <li>
                <a class="<?php if ($current_page == "index.php") {echo 'active-mobile-tab';} ?>" href="index.php">
                    Home
                </a>
            </li>
            <li>
                <a class="<?php if ($current_page == "news-and-events.php") {echo 'active-mobile-tab';} ?>" href="news-and-events.php">
                    News and Events
                </a>
            </li>
            <li>
                <a class="<?php if ($current_page == "apply-for-job.php") {echo 'active-mobile-tab';} ?>" href="apply-for-job.php">
                    Apply for Job
                </a>
            </li>
            <li>
                <a class="<?php if ($current_page == "about-us.php") {echo 'active-mobile-tab';} ?>" href="about-us.php">
                    About Us
                </a>
            </li>
            <li>
                <a class="<?php if ($current_page == "contact-us.php") {echo 'active-mobile-tab';} ?>" href="contact-us.php">
                    Contact Us
                </a>
            </li>
        </ul>
    </div>
    
</header>

<!-- jQuery Link -->
<script src="jquery/jquery-3.6.1.min.js"></script>

<script>
    $(document).scroll(function (e) {
        var height = $(window).scrollTop();
        // console.log(height);
        if (height > 34) {
            $('header').addClass('active')
            $('section').addClass('active')
            $('.top-line').hide()
        } else {
            $('header').removeClass('active')
            $('section').removeClass('active')
            $('.top-line').show()

        }
    })
    $('.menu').click(function () {
        $('.other-links-side').slideToggle()
        $('body').toggleClass('active')
    })
</script>