<?php

require '../../_config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

if ($_POST['clicked']) {

    $mail_send = false;

    // Getting Code to send 
    $get_sql = "SELECT * FROM `admin_panel` WHERE `id`='1'";
    $get_res = mysqli_query($conn, $get_sql);
    $data = mysqli_fetch_assoc($get_res);

    $code = $data['code'];

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
            $mail->Subject = 'Verification Link';                            // Message Subject
            $mail->Body    = 'Dear <b>Admin</b><br>This is your verification link 
            <a href="http://localhost/Shaheen_Academy_School/admin_panel/forgot-change-password.php?code='.$code.'">Click Here</a>';    // Message Body
            $mail->send();
            $mail_send = true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        if ($mail_send) {
            $output = "";

            $get_email_sql = "SELECT * FROM `email`";
            $get_email_res = mysqli_query($conn, $get_email_sql);
            $email_rows = mysqli_num_rows($get_email_res);

            if ($email_rows == 1) {
                
                $email_data = mysqli_fetch_assoc($get_email_res);
                $output = $email_data['email'];

            } else {
                for ($i=0; $i < $email_rows; $i++) {

                    $email_data = mysqli_fetch_assoc($get_email_res);
                    $output .= $email_data['email'].", ";

                }
            }
        
            echo $output;
        } else {
            echo 0;
        }
    } else {
        echo "not";
    }
    
}



?>