<?php

require "_config.php";

$event_head_id = $_GET['event-head-id'];

$get_sql = "SELECT * FROM `news_events_head` WHERE `id` = '$event_head_id'";
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
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Akaya+Kanadaka&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">     

    <link rel="stylesheet" href="fontawesome_icon/css/all.min.css">

    <link rel="stylesheet" href="css/_utils.css">
    <link rel="stylesheet" href="css/_sidebar-head.css">
    <link rel="stylesheet" href="css/bunch.css">

    <link rel="shortcut icon" href="src/static_images/logo.png" type="image/x-icon">
    
    <title>Admin Panel - Shaheen Children Academy</title>
</head>
<body>
<div class="head-main-container">

    <div class="main-container">
        <?php include '_sidebar.php'; ?>
        <div class="main-content">
            <?php include '_head.php'; ?>
            <!-- <?php echo $msg; ?> -->
            <div class="msg-section"></div>
            <div class="section">
                <h1>Add Bunch for <q><?php echo $data['event_head']; ?></q></h1>
                <div class="actions">
                    <form action="" method="post">
                        <input type="hidden" name="event-head-id" value="<?php echo $event_head_id; ?>">
                        <div class="head-div">
                            <label for="head">Add Head</label>
                            <input type="text" name="head" id="head">
                        </div>
                        <div class="description-div">
                            <label for="description">Add Description</label>
                            <textarea name="description" id="description"></textarea>
                        </div>
                        <div class="file-div">
                            <div class="input">
                                <label for="file">Add Image or Video</label>
                                <input type="file" name="file" id="file">
                            </div>
                            <div class="loading-bar">
                                <div class="outter">
                                    <div class="inner">70%</div>
                                </div>
                            </div>
                        </div>
                        <div class="btn">
                            <button type="submit" name="submit">Add</button>
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

<script src="jquery/jquery-3.6.1.min.js"></script>
<script> 
    
    $('form').submit(function (e) {
        e.preventDefault()
        
        var formData = new FormData(this)

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        // Place upload progress bar visibility code here
                        var percent = percentComplete + "%"
                        var roundedPercent = percentComplete.toFixed() + "%"

                        $(".loading-bar").show()
                        $('.inner').css('width', percent)
                        $(".inner").html(roundedPercent)

                    }
                }, false);
                return xhr;
            },
            url: 'processor/bunch/bunch-adder.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data == 'format-not-supported') {
                    var msg = `<div class="msg danger-msg">
                                <div class="left">
                                    <ion-icon class="icon" name="alert-circle-outline"></ion-icon>
                                </div>
                                <div class="right">
                                    <p>Please select video ('.mp4', '.mov', '.avi', '.flv', '.mkv', '.wmv') 
                                    or image ('.png', '.jpg', '.jpeg', '.gif', '.tiff') to upload.</p>
                                </div>
                            </div>`
                } else if (data == 'file-size-large') {
                    var msg = `<div class="msg danger-msg">
                                <div class="left">
                                    <ion-icon class="icon" name="alert-circle-outline"></ion-icon>
                                </div>
                                <div class="right">
                                    <p>Please select file under size of 1gb.</p>
                                </div>
                            </div>`
                } else if (data == 'not-set') {
                    var msg = `<div class="msg danger-msg">
                                <div class="left">
                                    <ion-icon class="icon" name="alert-circle-outline"></ion-icon>
                                </div>
                                <div class="right">
                                    <p>Please fill all fields and select image or video.</p>
                                </div>
                            </div>`
                } else if (data == 0) {
                    var msg = `<div class="msg danger-msg">
                                <div class="left">
                                    <ion-icon class="icon" name="alert-circle-outline"></ion-icon>
                                </div>
                                <div class="right">
                                    <p>Something went wrong.</p>
                                </div>
                            </div>`
                } else if (data == 1) {
                    var msg = `<div class="msg success-msg">
                                <div class="left">
                                    <ion-icon class="icon" name="checkmark-circle-outline"></ion-icon>
                                </div>
                                <div class="right">
                                    <p>Bunch has been added.</p>
                                </div>
                            </div>`
                    setTimeout(() => {
                        window.location.href = "news-and-events.php"
                    }, 1000);
                }
                $('.msg-section').html(msg)
            }
        })

        $.ajax({
            url: 'processor/bunch/bunch-adder.php',
            type: 'POST',
            data: formData,
            success: function (data) {
                if (data == 'format-not-supported') {
                    var msg = `<div class="msg danger-msg">
                                <div class="left">
                                    <ion-icon class="icon" name="alert-circle-outline"></ion-icon>
                                </div>
                                <div class="right">
                                    <p>Please select video ('.mp4', '.mov', '.avi', '.flv', '.mkv', '.wmv') 
                                    or image ('.png', '.jpg', '.jpeg', '.gif', '.tiff') to upload.</p>
                                </div>
                            </div>`
                } else if (data == 'file-size-large') {
                    var msg = `<div class="msg danger-msg">
                                <div class="left">
                                    <ion-icon class="icon" name="alert-circle-outline"></ion-icon>
                                </div>
                                <div class="right">
                                    <p>Please select file under size of 1gb.</p>
                                </div>
                            </div>`
                } else if (data == 'not-set') {
                    var msg = `<div class="msg danger-msg">
                                <div class="left">
                                    <ion-icon class="icon" name="alert-circle-outline"></ion-icon>
                                </div>
                                <div class="right">
                                    <p>Please fill all fields and select image or video.</p>
                                </div>
                            </div>`
                } else if (data == 0) {
                    var msg = `<div class="msg danger-msg">
                                <div class="left">
                                    <ion-icon class="icon" name="alert-circle-outline"></ion-icon>
                                </div>
                                <div class="right">
                                    <p>Something went wrong.</p>
                                </div>
                            </div>`
                } else if (data == 1) {
                    var msg = `<div class="msg success-msg">
                                <div class="left">
                                    <ion-icon class="icon" name="checkmark-circle-outline"></ion-icon>
                                </div>
                                <div class="right">
                                    <p>Bunch has been added.</p>
                                </div>
                            </div>`
                    setTimeout(() => {
                        window.location.href = "news-and-events.php"
                    }, 1000);
                }
                $('.msg-section').html(msg)
            }
        })

        // });


    })
</script>
</html>