<?php

require "_config.php";
$msg = "";


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
    <link rel="stylesheet" href="css/messages.css">

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
                <div class="head-search-div">
                    <h1>Messages</h1>
                    <div class="search-div">
                        <label for="search">Search Message</label>
                        <input type="text" id="search" placeholder="Search...">
                    </div>
                </div>
                <div class="actions">
                    <div class="messages">
                        <?php
                        
                        $get_sql = "SELECT * FROM `contact_messages` ORDER BY `id` DESC";
                        $get_res = mysqli_query($conn, $get_sql);
                        $rows = mysqli_num_rows($get_res);

                        if ($rows > 0) {
                            for ($i=0; $i < $rows; $i++) { 
                                $data = mysqli_fetch_assoc($get_res);

                                if (strlen($data['name']) > 18) {
                                    $name = substr($data['name'], 0, 15).'...';
                                } else {
                                    $name = $data['name'];
                                }

                                echo '<div class="message">
                                        <span class="datetime">Applied at : <b>'.$data['datetime'].'</b></span>
                                        <div class="message-head">
                                            <h1>Message from <q>'.$name.'</q></h1>
                                            <button class="del-btn" data-id="'.$data['id'].'">Delete</button>
                                        </div>
                                        <div class="infos">
                                            <span><b>Name : </b><br>
                                                '.$data['name'].'
                                            </span>
                                            <span><b>Phone Number : </b><br>
                                                '.$data['phone'].'
                                            </span>
                                            <span><b>Email Address : </b><br>
                                                '.$data['email'].'
                                            </span>
                                            <span class="subject-span"><b>Subject : </b><br>
                                                '.$data['subject'].'
                                            </span>
                                            <span class="msg-span"><b>Message : </b><br>
                                                '.$data['message'].'
                                            </span>
                                        </div>
                                    </div>';                            
                            }
                        } else {
                            echo 'No messages yet.';
                        }
                        

                        ?>
                    <!-- <div class="message">
                        <div class="message-head">
                            <h1>Message from <q>Azam</q></h1>
                            <button>Delete</button>
                        </div>
                        <div class="infos">
                            <span><b>Name : </b><br>
                                Azam
                            </span>
                            <span><b>Phone Number : </b><br>
                                03101120402
                            </span>
                            <span><b>Email Address : </b><br>
                                azam78454@gmail.com
                            </span>
                            <span class="subject-span"><b>Subject : </b><br>
                                Problem
                            </span>
                            <span class="msg-span"><b>Message : </b><br>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus similique sint magnam dolor in provident perspiciatis consectetur, placeat non incidunt? Dicta quas ipsa accusantium sapiente, ut beatae nostrum voluptates incidunt!
                            </span>
                        </div>
                    </div> -->
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

    $(document).on('click', ".del-btn", function () {
        var btn_id = $(this).data('id')

        console.log(btn_id);

        $.ajax({
            url: 'processor/messages-action/message-deleter.php',
            type: 'POST',
            data: {
                id: btn_id
            },
            success: function (data) {
                // console.log(data);
                if (data == 0) {
                    window.location.href = window.location.href
                } else {
                    console.log(data);
                }
            }
        })
    })

    $('#search').on('keyup', function () {
        var search = $('#search').val()
        
        $.ajax({
            url : 'processor/messages-action/message-search.php',
            type : 'POST',
            data : {
                search : search
            },
            success : function (data) {
                // console.log(data);
                $('.messages').html(data)
                // if (data == 0) {
                //     window.location.href = window.location.href
                // } else {
                //     console.log(data);
                // }
            }
        })
    })

</script>
</html>