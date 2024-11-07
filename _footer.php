<?php

require "_config.php";

$get_sql = "SELECT * FROM `information`";
$get_res = mysqli_query($conn, $get_sql);
$data = mysqli_fetch_assoc($get_res);

?>

<footer>
    <div class="left">
        Copyright &copy; 2022 - Shaheen Academy School - All rights reserved.
    </div>
    <div class="right">
        <a target="_blank" href="<?php echo $data['facebook_url'] ?>"><i class="fa-brands fa-facebook-f"></i></a>
        <a target="_blank" href="<?php echo $data['insta_url'] ?>"><i class="fa-brands fa-instagram"></i></a>
    </div>
</footer>

<script>
    $(".black").click(function () {
        $('.other-links-side').slideUp()
        $('body').removeClass('active')
    })
</script>