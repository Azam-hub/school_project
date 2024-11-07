<?php

require "_config.php";
$msg = "";

if (isset($_POST['submit'])) {
    $old_password = $_POST['old-password'];
    $new_password = $_POST['new-password'];
    $confirm_new_password = $_POST['confirm-new-password'];

    $get_sql = "SELECT * FROM `admin_panel` WHERE `id`='1'";
    $get_res = mysqli_query($conn, $get_sql);

    $data = mysqli_fetch_assoc($get_res);
    $hashed_password = $data['password'];

    $match = password_verify($old_password, $hashed_password);

    if ($new_password !== $confirm_new_password) {
        $msg = '<div class="msg danger-msg">
                    <div class="left">
                        <ion-icon class="icon" name="alert-circle-outline"></ion-icon>
                    </div>
                    <div class="right">
                        <p>Password and Confirm Password does not match.</p>
                    </div>
                </div>';
    } else {
        if ($match) {
            $hashed_new_password = password_hash($new_password, PASSWORD_BCRYPT);

            $update_sql = "UPDATE `admin_panel` SET `password`='$hashed_new_password' WHERE `id`='1'";
            $update_res = mysqli_query($conn, $update_sql);

            if ($update_res) {
                $msg = '<div class="msg success-msg">
                            <div class="left">
                                <ion-icon class="icon" name="checkmark-circle-outline"></ion-icon>
                            </div>
                            <div class="right">
                                <p>Your password has been changed.</p>
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
        } else {
            $msg = '<div class="msg danger-msg">
                        <div class="left">
                            <ion-icon class="icon" name="alert-circle-outline"></ion-icon>
                        </div>
                        <div class="right">
                            <p>Incorrect Old Password.</p>
                        </div>
                    </div>';
        }
    }

    
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
    <link href="https://fonts.googleapis.com/css2?family=Akaya+Kanadaka&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">     

    <link rel="stylesheet" href="fontawesome_icon/css/all.min.css">

    <link rel="stylesheet" href="css/_utils.css">
    <link rel="stylesheet" href="css/_sidebar-head.css">
    <link rel="stylesheet" href="css/change-password.css">

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
                <h1>Change Password</h1>
                <form action="" method="post">
                    <div class="actions">
                        <div class="old-password-div">
                            <label for="old-password">Old Password</label>
                            <input type="password" name="old-password" id="old-password" placeholder="Enter your Old Password">
                        </div>
                        <div class="skip-div"></div>
                        <div class="new-password-div">
                            <label for="new-password">New Password</label>
                            <input type="password" name="new-password" id="new-password" placeholder="Enter your New Password">
                        </div>
                        <div class="confirm-new-password-div">
                            <label for="confirm-new-password">Confirm New Password</label>
                            <input type="password" name="confirm-new-password" id="confirm-new-password" placeholder="Enter your New Confirm Password">
                        </div>
                        <div class="btn">
                            <button type="submit" name="submit">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://kit.fontawesome.com/0d21e1944b.js" crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</html>