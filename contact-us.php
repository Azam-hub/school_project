<?php

require "_config.php";
date_default_timezone_set("Asia/Karachi");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mail_sender/vendor/autoload.php';

$mail = new PHPMailer(true);

$msg = "";

if (isset($_POST['send'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $datetime = date("H:i - d M y");

    $insert_sql = "INSERT INTO `contact_messages` (`name`, `phone`, `email`, `subject`, `message`, `datetime`) 
                    VALUES ('$name', '$phone', '$email', '$subject', '$message', '$datetime')";
    $insert_res = mysqli_query($conn, $insert_sql);

    if ($insert_res) {
        $msg = '<div class="msg success-msg">
                    <div class="left">
                        <ion-icon class="icon" name="checkmark-circle-outline"></ion-icon>
                    </div>
                    <div class="right">
                        <p>Your message has been sent. We will contact you through your phone number or email address.</p>
                    </div>
                </div>';

        // Getting Email rows
        $get_email_sql = "SELECT * FROM `email` WHERE `status` = 'active'";
        $get_email_res = mysqli_query($conn, $get_email_sql);
        $email_rows = mysqli_num_rows($get_email_res);

        if ($email_rows > 0) {
            try {
                $mail->SMTPDebug = 0;                                       
                $mail->isSMTP();                                            
                $mail->Host       = 'smtp.gmail.com';                    
                $mail->SMTPAuth   = true;                             
                $mail->Username   = $mail_from;                 
                $mail->Password   = $mail_password;                        
                $mail->SMTPSecure = 'tls';                              
                $mail->Port       = 587;  
            
                $mail->setFrom($mail_from, 'Shaheen Children Academy');         // Sender address and name
                // $mail->addAddress($email);                               // Receiver address and name
        
                // Sending mail to all email addresses
                for ($i=0; $i < $email_rows; $i++) { 
        
                    $email_data = mysqli_fetch_assoc($get_email_res);
                                
                    $mail->addAddress($email_data['email']);
                }
                
                $mail->isHTML(true);                                  
                $mail->Subject = 'Job Application';                            // Message Subject
                $mail->Body    = '
                Dear <b>Admin</b><br><br>
                There is a message from <b style="font-size:20px;"><q>'.$name.'</q></b>. Please check it on Admin Panel.
                
                ';    // Message Body
                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

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
    <link rel="stylesheet" href="css/contact-us.css">
    <link rel="shortcut icon" href="src/logo.png" type="image/x-icon">
    <title>Contact Us - Shaheen Children Academy</title>
</head>
<body>
<div class="head-main-container">
    <?php include "_header.php"; ?>
    <?php echo $msg; ?>
    <div class="msg-head"></div>
    <section>
        <div class="head-part">
            <h1 class="main-head">Contact Us</h1>
        </div>
        <div class="form-map-container">
            <div class="form-container">
                <form action="" method="post" id="form">
                    <div class="name-div">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter your Name">
                    </div>
                    <div class="phone-div">
                        <label for="phone">Phone</label>
                        <input type="number" id="phone" name="phone" placeholder="Enter your Phone Number">
                    </div>
                    <div class="email-div">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" placeholder="Enter your Email">
                    </div>
                    <div class="subject-div">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" placeholder="Enter your Subject">
                    </div>
                    <div class="message-div">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" placeholder="Type Message here..."></textarea>
                    </div>
                    <div class="send-div">
                        <button name="send" class="send-btn">Send</button>
                        <img src="src/loading.gif" alt="Loading" class="loading-gif">
                    </div>
                </form>
            </div>
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3618.741646811262!2d67.20787192358301!3d24.906792631529246!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb3376bc6c96dcb%3A0x97caf4a634c35c67!2sShaheen%20Children%20Academy!5e0!3m2!1sen!2s!4v1667732918531!5m2!1sen!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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

<script>

    $("#form").submit(function (e) {

        $(".msg").remove()
        $(".loading-gif").show()

        var name = $('#name').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var subject = $('#subject').val();
        var message = $('#message').val();

        function for_error(text) {
            e.preventDefault()
            $(".loading-gif").hide()
            var msg = `<div class="msg danger-msg">
                            <div class="left">
                                <ion-icon class="icon" name="alert-circle-outline"></ion-icon>
                            </div>
                            <div class="right">
                                <p>${text}</p>
                            </div>
                        </div>`;
            $('.msg-head').html(msg)
            $("html, body").animate({
                scrollTop: 0
            }, 100); 

        }
    
        if (name == "") {
            for_error('Please Enter your Name.')
        } else if (phone == "" && email == "") {
            for_error('Please Enter your Phone number or Email.')
        } else if (subject == "") {
            for_error('Please Enter Subject.')
        } else if (message == "") {
            for_error('Please Enter some Message.')
        }
    })
    
    // $(".send-btn").click(function () {
    //     $(".loading-gif").show()
    // })
</script>

</html>