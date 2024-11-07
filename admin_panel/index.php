<?php

require "_config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'processor/mail_sender/vendor/autoload.php';

$mail = new PHPMailer(true);

$msg = "";

if (isset($_GET['code']) && isset($_GET['email']) && isset($_GET['action']) && $_GET['action'] == 'add') {
    $url_code = $_GET['code'];
    $url_email = $_GET['email'];

    $get_sql = "SELECT * FROM `email` WHERE `email` = '$url_email'";
    $get_res = mysqli_query($conn, $get_sql);
    $data = mysqli_fetch_assoc($get_res);
    $db_code = $data['code'];
    
    if ($db_code === $url_code) {
        $update_sql = "UPDATE `email` SET `code`='', `status`='active' WHERE `email` = '$url_email'";
        $update_res = mysqli_query($conn, $update_sql);

        if ($update_res) {
            $msg = '<div class="msg success-msg">
                        <div class="left">
                            <ion-icon class="icon" name="checkmark-circle-outline"></ion-icon>
                        </div>
                        <div class="right">
                            <p>This email address <b>"'.$url_email.'"</b> has been active.</p>
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
                        <p>Incorrect Verification Link!.</p>
                    </div>
                </div>';
    }

} elseif (isset($_GET['code']) && isset($_GET['id']) && isset($_GET['email']) && isset($_GET['action']) && $_GET['action'] == 'update') {
    $url_code = $_GET['code'];
    $url_email = $_GET['email'];
    $url_id = $_GET['id'];

    $get_sql = "SELECT * FROM `email` WHERE `id` = '$url_id'";
    $get_res = mysqli_query($conn, $get_sql);
    $data = mysqli_fetch_assoc($get_res);
    $db_code = $data['code'];
    
    if ($db_code === $url_code) {
        $update_sql = "UPDATE `email` SET `email`='$url_email', `code`='', `status`='active' WHERE `id` = '$url_id'";
        $update_res = mysqli_query($conn, $update_sql);

        if ($update_res) {
            $msg = '<div class="msg success-msg">
                        <div class="left">
                            <ion-icon class="icon" name="checkmark-circle-outline"></ion-icon>
                        </div>
                        <div class="right">
                            <p>This email address <b>"'.$url_email.'"</b> has been active.</p>
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
                        <p>Incorrect Verification Link!.</p>
                    </div>
                </div>';
    }
}

if (isset($_POST['submit'])) {
    $email = $_POST['add-email'];
    $duplicate_email = false;

    $get_sql = "SELECT * FROM `email` WHERE `email` = '$email'";
    $get_res = mysqli_query($conn, $get_sql);
    $get_rows = mysqli_num_rows($get_res);

    if ($get_rows > 0) {
        $duplicate_email = true;
    }    

    if (!$duplicate_email) {
            
        function abc($length){
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
        
            for ($i = 0; $i < $length; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }
        
            return $randomString;
        }
        $code = abc(50);

        $mail_send = false;

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
            $mail->addAddress($email);                               // Receiver address and name
            
            $mail->isHTML(true);                                  
            $mail->Subject = 'Verification Link';                            // Message Subject
            $mail->Body    = 'Dear <b>Admin</b><br>This is your verification link 
            <a href="http://localhost/Shaheen_Academy_School/admin_panel/index.php?action=add&code='.$code.'&email='.$email.'">Click Here</a>';    // Message Body
            $mail->send();
            $mail_send = true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        if ($mail_send) {
            
            $insert_sql = "INSERT INTO `email` (`email`, `code`, `status`) VALUE ('$email', '$code', 'pending')";
            $insert_res = mysqli_query($conn, $insert_sql);

            if ($insert_res) {
                $msg = '<div class="msg success-msg">
                            <div class="left">
                                <ion-icon class="icon" name="checkmark-circle-outline"></ion-icon>
                            </div>
                            <div class="right">
                                <p>A mail has been sent on email address <b>"'.$email.'"</b>, please verify it.</p>
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
                        <p>This email address <b>"'.$email.'"</b> has already been added.</p>
                    </div>
                </div>';
    }
}

if (isset($_POST['update'])) {
    $email = $_POST['edit-email'];
    $id = $_POST['id'];

    $duplicate_email = false;

    $get_sql = "SELECT * FROM `email` WHERE `email` = '$email'";
    $get_res = mysqli_query($conn, $get_sql);
    $get_rows = mysqli_num_rows($get_res);

    if ($get_rows > 0) {
        $duplicate_email = true;
    }

    if (!$duplicate_email) {

        function abc($length){
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
        
            for ($i = 0; $i < $length; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }
        
            return $randomString;
        }
        $code = abc(50);

        $mail_send = false;

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
            $mail->addAddress($email);                               // Receiver address and name
            
            $mail->isHTML(true);                                  
            $mail->Subject = 'Verification Link';                            // Message Subject
            $mail->Body    = 'Dear <b>Admin</b><br>This is your verification link 
            <a href="http://localhost/Shaheen_Academy_School/admin_panel/index.php?action=update&id='.$id.'&code='.$code.'&email='.$email.'">Click Here</a>';    // Message Body
            $mail->send();
            $mail_send = true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        if ($mail_send) {
        
            $update_sql = "UPDATE `email` SET `code`='$code', `status`='pending' WHERE `id`='$id'";
            $update_res = mysqli_query($conn, $update_sql);
            
            if ($update_res) {
                $msg = '<div class="msg success-msg">
                            <div class="left">
                                <ion-icon class="icon" name="checkmark-circle-outline"></ion-icon>
                            </div>
                            <div class="right">
                                <p>A mail has been sent on email address <b>"'.$email.'"</b>, please verify it.</p>
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
                        <p>This email address <b>"'.$email.'"</b> has already been added.</p>
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
    <link rel="stylesheet" href="css/_sidebar-head.css">
    <link rel="stylesheet" href="css/home.css">

    <link rel="shortcut icon" href="src/static_images/logo.png" type="image/x-icon">
    
    <title>Admin Panel - Shaheen Children Academy</title>
</head>
<body>
<div class="head-main-container">
    <div class="add-modal modal">
        <i class="icon fa-solid fa-xmark"></i>
        <h1>Add Email Address</h1>
        <form method="POST">
            <label for="email">Add Email Address</label>
            <input type="email" name="add-email" placeholder="Enter your Email Address" autofocus>
            <div class="btn">
                <button type="submit" class="modal-btn" name="submit">Add</button>
                <img class="loading-gif" src="src/static_images/loading.gif" alt="Pic">
            </div>
        </form>
    </div>
    <div class="edit-modal modal">
        <i class="icon fa-solid fa-xmark"></i>
        <h1>Edit Email Address</h1>
        <form method="POST">
            <label for="email">Edit Email Address</label>
            <input type="hidden" id="id-input" name="id">
            <input type="email" name="edit-email" id="edit-input" placeholder="Enter your Email Address" autofocus>
            <div class="btn">
                <button type="submit" class="modal-btn" name="update">Update</button>
                <img class="loading-gif" src="src/static_images/loading.gif" alt="Pic">
            </div>
        </form>
    </div>

    <div class="black-bg"></div>

    <div class="main-container">
        <?php include '_sidebar.php'; ?>
        <div class="main-content">
            <?php include '_head.php'; ?>
            <?php echo $msg; ?>
            <div class="section">
                <h1>General Actions</h1>
                <div class="actions">
                    <div class="email-div">
                        <h2>Email Addresses</h2>
                        <div class="table-container">
                            <?php

                            $get_sql = "SELECT * FROM `email`";
                            $get_res = mysqli_query($conn, $get_sql);
                            $rows = mysqli_num_rows($get_res);

                            if ($rows > 0) {
                                echo '<table>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Email Address</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>';

                                for ($i=0; $i < $rows; $i++) {
                                    $data = mysqli_fetch_assoc($get_res);

                                    echo '<tr>
                                            <td>'.($i+1).'</td>
                                            <td>'.$data['email'].'</td>';
                                            
                                            if ($data['status'] == 'pending') {
                                                echo '<td class="pending"><span>Pending</span></td>';
                                            } else {
                                                echo '<td class="active"><span>Active</span></td>';
                                                
                                            }
                                            
                                            echo '<td class="actions-td">
                                                <button class="edit-btn" data-id="'.$data['id'].'">Edit</button>
                                                <button class="del-btn" data-id="'.$data['id'].'">Delete</button>
                                            </td>
                                        </tr>';
                                }
                                        
                                echo '</table>';
                            } else {
                                echo "<p style='margin-top:10px'>No Email Address yet.</p>";
                            }
                            

                            ?>
                            
                        </div>
                        <p><b>Note:</b> Add and active all emails by verify which will receive mails on job application and forgot password link.</p>
                        <a href="" class="add-email">Add Email Address</a>
                    </div>
                    <div class="password-change-div">
                        <h2>Change Password</h2>
                        <a href="change-password.php">Change Password</a>
                    </div>
                </div>
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

    $('.modal-btn').click(function () {
        $(this).next().show()
    })

    $(".add-email").click(function (e) {
        e.preventDefault()
        $(".head-main-container").addClass('add-modal-active')

        $('.add-modal input').focus()
    })    

    $(".edit-btn").on('click', function () {
        $(".head-main-container").addClass('edit-modal-active')

        $('.edit-modal input').focus()

        var id = $(this).data('id');

        var value = $(this).parent().prev().prev().text()

        $("#id-input").val(id)
        $("#edit-input").val(value)

    })

    $('.modal .icon, .black-bg').click(function () {
        if ($(".head-main-container").hasClass('add-modal-active')) {
            $(".head-main-container").removeClass('add-modal-active')
        } else {
            $(".head-main-container").removeClass('edit-modal-active')
        }
        
    })

    $(".del-btn").on('click', function () {
        var this_btn = $(this)
        var id = this_btn.data('id')

        $.ajax({
            url: "processor/email-deleter.php",
            type: "POST",
            data: {
                action: "del",
                id: id
            },
            success: function (data) {
                if (data == 1) {
                    window.location.href = window.location.href
                } else {
                    console.log(data);
                }
            }
        })
    })
</script>
</html>