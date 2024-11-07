<?php

require "_config.php";
session_start();
$msg = "";

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    header("location: index.php");
}

if (isset($_POST["submit"])) {
    $password = $_POST['password'];

    $get_sql = "SELECT * FROM `admin_panel` WHERE `id`='1'";
    $get_res = mysqli_query($conn, $get_sql);

    $data = mysqli_fetch_assoc($get_res);
    $hashed_password = $data['password'];

    $match = password_verify($password, $hashed_password);

    if ($match) {
        $_SESSION['logged_in'] = true;
        header("location: index.php");
    } else {
        $msg = '<div class="msg danger-msg">
                    <div class="left">
                        <ion-icon class="icon" name="alert-circle-outline"></ion-icon>
                    </div>
                    <div class="right">
                        <p>Incorrect Password.</p>
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
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter your Password" autofocus>
                    </div>
                    <div class="forgot-password-div">
                        <img class="loading-gif" src="src/static_images/loading.gif" alt="Pic">
                        <p class="forgot-password">Forgot Password?</p>
                    </div>
                    <div class="btn">
                        <button type="submit" name="submit">Login</button>
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

<script>
    $('.forgot-password').click(function () {
        $('.loading-gif').show();
        $.ajax({
            url: "processor/mail_sender/mail_sender.php",
            type: 'POST',
            data: {
                clicked: true
            },
            success: function (data) {
                if (data != 0 && data != "not") {
                    console.log(data);
                    var msg = `
                    <div class="msg success-msg">
                        <div class="left">
                            <ion-icon class="icon" name="checkmark-circle-outline"></ion-icon>
                        </div>
                        <div class="right">
                            <p>A verification mail has been sent on <b><q>${data}</q></b>.</p>
                        </div>
                    </div>
                    `;
                    $('.head-main-container').prepend(msg)
                } else if (data == "not") {
                    
                    var msg = `
                        <div class="msg danger-msg">
                            <div class="left">
                                <ion-icon class="icon" name="alert-circle-outline"></ion-icon>
                            </div>
                            <div class="right">
                                <p>Oops! You wanted to add email on Admin Panel.</p>
                            </div>
                        </div>
                    `;

                    $('.head-main-container').prepend(msg)

                } else {
                    console.log(data);
                }

                $('.loading-gif').hide();
            }
        })
    })
</script>
</html>