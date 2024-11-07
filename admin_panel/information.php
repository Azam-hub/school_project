<?php

require "_config.php";
$msg = "";

if (isset($_POST['submit'])) {
    $first_para = mysqli_real_escape_string($conn, $_POST['first-para']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone-number']);
    $gmail_id = mysqli_real_escape_string($conn, $_POST['gmail-id']);
    $facebook_link = mysqli_real_escape_string($conn, $_POST['facebook-link']);
    $insta_link = mysqli_real_escape_string($conn, $_POST['insta-link']);

    // $insert_sql = "INSERT INTO `information` (`first_para`, `phone_number`, `gmail_id`, `facebook_url`, `insta_url`) 
    //                 VALUES ('$first_para', '$phone_number', '$gmail_id', '$facebook_link', '$insta_link')";

    $update_sql = "UPDATE `information` SET `first_para`='$first_para', `facebook_url`='$facebook_link', 
                    `insta_url`='$insta_link', `phone_number`='$phone_number', `gmail_id`='$gmail_id'";
    $update_res = mysqli_query($conn, $update_sql);

    if ($update_res) {
        $msg = '<div class="msg success-msg">
                    <div class="left">
                        <ion-icon class="icon" name="checkmark-circle-outline"></ion-icon>
                    </div>
                    <div class="right">
                        <p>Information has been updated.</p>
                    </div>
                </div>';
    } else {
        $msg = '<div class="msg danger-msg">
                    <div class="left">
                        <ion-icon class="icon" name="alert-circle-outline"></ion-icon>
                    </div>
                    <div class="right">
                        <p>Something went wrong.</p>
                    </div>
                </div>';
    }

    
}
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
    <link rel="stylesheet" href="css/_sidebar-head.css">
    <link rel="stylesheet" href="css/information.css">

    <link rel="shortcut icon" href="src/static_images/logo.png" type="image/x-icon">
    
    <title>Admin Panel - Shaheen Children Academy</title>
</head>
<body>
<div class="head-main-container">
    <div class="main-container">
        <?php include '_sidebar.php'; ?>
        <div class="main-content">
            <?php include '_head.php'; ?>
            <?php echo $msg; ?>

            <div class="section">
                <h1>Informations</h1>
                <div class="actions">
                    <form action="" method="POST">
                        <div class="first-para-div">
                            <label for="first-para">Enter First Paragraph Text <b>(Max 60 Words)</b></label>
                            <textarea name="first-para" id="first-para" cols="60" rows="7"><?php echo $data['first_para'] ?></textarea>
                        </div>
                        <div class="skip"></div>
                        <div class="facebook-link-div">
                            <label for="facebook-link">Enter Facebook Link</label>
                            <input name="facebook-link" id="facebook-link" value="<?php echo $data['facebook_url'] ?>">
                        </div>
                        <div class="insta-link-div">
                            <label for="insta-link">Enter Instagram Link</label>
                            <input name="insta-link" id="insta-link" value="<?php echo $data['insta_url'] ?>">
                        </div>
                        <div class="phone-number-div">
                            <label for="phone-number">Enter Phone Number</label>
                            <input name="phone-number" id="phone-number" value="<?php echo $data['phone_number'] ?>">
                        </div>
                        <div class="gmail-id-div">
                            <label for="gmail-id">Enter Gmail ID</label>
                            <input name="gmail-id" id="gmail-id" value="<?php echo $data['gmail_id'] ?>">
                        </div>
                        <div class="btn">
                            <button type="submit" name="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://kit.fontawesome.com/0d21e1944b.js" crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</html>