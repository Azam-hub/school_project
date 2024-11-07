<?php

require "_config.php";
session_start();
$msg = "";

// if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
//     header("location: index.php");
// }

if (isset($_POST["submit"])) {

    $url_code = $_GET['code'];
    
    $get_sql = "SELECT * FROM `admin_panel` WHERE `id`='1'";
    $get_res = mysqli_query($conn, $get_sql);
    $data = mysqli_fetch_assoc($get_res);

    $database_code = $data['code'];

    if ($url_code === $database_code) {
        
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];

        if ($password !== $confirm_password) {
            $msg = '<div class="msg danger-msg">
                        <div class="left">
                            <ion-icon class="icon" name="alert-circle-outline"></ion-icon>
                        </div>
                        <div class="right">
                            <p>Password and Confirm Password does not match.</p>
                        </div>
                    </div>';
        } else {
            
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                    
            function abc(){
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $randomString = '';
            
                for ($i = 0; $i < 50; $i++) {
                    $index = rand(0, strlen($characters) - 1);
                    $randomString .= $characters[$index];
                }
            
                return $randomString;
            }
            $code = abc();

            $update_sql = "UPDATE `admin_panel` SET `password`='$hashed_password', `code`='$code' WHERE `id`='1'";
            $update_res = mysqli_query($conn, $update_sql);    

            $msg = '<div class="msg success-msg">
                        <div class="left">
                            <ion-icon class="icon" name="checkmark-circle-outline"></ion-icon>
                        </div>
                        <div class="right">
                            <p>Password has been changed successfully.</p>
                        </div>
                    </div>';
        }
    } else {
        $msg = '<div class="msg danger-msg">
                    <div class="left">
                        <ion-icon class="icon" name="alert-circle-outline"></ion-icon>
                    </div>
                    <div class="right">
                        <p>Incorrect Link!.</p>
                    </div>
                </div>';
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
    <link rel="stylesheet" href="css/login.css">

    <link rel="shortcut icon" href="src/static_images/logo.png" type="image/x-icon">

    <title>Admin Panel - Shaheen Children Academy</title>
</head>
<body>
<div class="head-main-container">
    <?php echo $msg; ?>
    <div class="main-container">
        <div class="box">
            <div class="top">
                <h1>Shaheen Children Academy</h1>
            </div>
            <div class="bottom">
                <h2>Login at Admin Panel</h2>
                <form action="" method="post">
                    <div class="password-div">
                        <label for="password">New Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter your New Password" autofocus>
                    </div>
                    <div class="confirm-password-div">
                        <label for="confirm-password">Confirm New Password</label>
                        <input type="password" name="confirm-password" id="confirm-password" placeholder="Enter your Confirm New Password">
                    </div>
                    <div class="btn">
                        <button type="submit" name="submit">Change Password</button>
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
<script src="jquery/jquery-3.6.1.min.js"></script>

</html>