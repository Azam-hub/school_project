<?php

require "_config.php";
date_default_timezone_set("Asia/Karachi");

$msg = "";


if (isset($_POST['add-event-head-submit'])) {

    $event_head = mysqli_real_escape_string($conn, $_POST['add-event-head']);
    $datetime = date("H:i - d M y");
    $for_name_datetime = date("H_i_s-d_M_y");

    if ($_FILES["add-file"]['name'][0] != "") {

        $file_name = $_FILES['add-file']['name'];
        $file_tmp_name = $_FILES['add-file']['tmp_name'];
        $file_type = $_FILES['add-file']['type'];
        $file_size = $_FILES['add-file']['size'];

        $format = true;
        $size = true;

        foreach ($file_name as $key => $value) {
            $extension = strtolower(pathinfo($value, PATHINFO_EXTENSION));
            $formats_arr = ['png', 'jpg', 'jpeg', 'gif', 'tiff'];

            if (!in_array($extension, $formats_arr)) {
                $format = false;
                break;
            }
        }

        foreach ($file_size as $key => $value) {
            if ($value > 1073741824) {
                $size = false;
                break;
            }
        }

        if (!$format) {
            $msg = '<div class="msg danger-msg">
                        <div class="left">
                            <ion-icon class="icon" name="alert-circle-outline"></ion-icon>
                        </div>
                        <div class="right">
                            <p>Please select image of format (".png", ".jpg", ".jpeg", ".gif", ".tiff") to upload.</p>
                        </div>
                    </div>';
        } elseif (!$size) {
            $msg = '<div class="msg danger-msg">
                        <div class="left">
                            <ion-icon class="icon" name="alert-circle-outline"></ion-icon>
                        </div>
                        <div class="right">
                            <p>Please select image under size of 1gb to upload.</p>
                        </div>
                    </div>';
        } else {

            $uploaded = true;
            $file_names_arr = [];

            foreach ($file_name as $key => $value) {
                $extension = strtolower(pathinfo($value, PATHINFO_EXTENSION));

                if (strpos($event_head, '\\') || strpos($event_head, '/')) {
                    $file_name = $key.'_@'.$for_name_datetime.'.'.$extension;
    
                } else {
                    $file_name = $key.'_'.$event_head.'@'.$for_name_datetime.'.'.$extension;

                }
                $path = 'src/dynamic_src/thumbnail/'.$file_name;
                array_push($file_names_arr, $file_name);

                if (!move_uploaded_file($file_tmp_name[$key], $path)) {
                    $uploaded = false;
                    break;
                }
            }

            if ($uploaded) {
                $file_names_string = implode("#|#", $file_names_arr);
                $insert_sql = "INSERT INTO `news_events_head` (`event_head`, `file_name`, `datetime`) VALUES ('$event_head', '$file_names_string', '$datetime')";
                $insert_res = mysqli_query($conn, $insert_sql);
            
                if ($insert_res) {
                    $msg = '<div class="msg success-msg">
                                <div class="left">
                                    <ion-icon class="icon" name="checkmark-circle-outline"></ion-icon>
                                </div>
                                <div class="right">
                                    <p>Event Head has been added.</p>
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
                                <p>Image can\'t be upload.</p>
                            </div>
                        </div>';
            }
        }
        
    } else {
        $msg = '<div class="msg danger-msg">
                    <div class="left">
                        <ion-icon class="icon" name="alert-circle-outline"></ion-icon>
                    </div>
                    <div class="right">
                        <p>Please select thumbnail image.</p>
                    </div>
                </div>';
    }
}

if (isset($_POST['edit-event-head-submit'])) {
    
    $event_head = mysqli_real_escape_string($conn, $_POST['edit-event-head']);
    $id = $_POST['event-head-id'];
    $datetime = date("H:i - d M y");
    $for_name_datetime = date("H_i_s-d_M_y");

    if ($_FILES["edit-file"]['name'][0] != "") {

        $file_name = $_FILES['edit-file']['name'];
        $file_tmp_name = $_FILES['edit-file']['tmp_name'];
        $file_type = $_FILES['edit-file']['type'];
        $file_size = $_FILES['edit-file']['size'];

        $format = true;
        $size = true;

        foreach ($file_name as $key => $value) {
            $extension = strtolower(pathinfo($value, PATHINFO_EXTENSION));
            $formats_arr = ['png', 'jpg', 'jpeg', 'gif', 'tiff'];

            if (!in_array($extension, $formats_arr)) {
                $format = false;
                break;
            }
        }

        foreach ($file_size as $key => $value) {
            if ($value > 1073741824) {
                $size = false;
                break;
            }
        }

        if (!$format) {
            $msg = '<div class="msg danger-msg">
                        <div class="left">
                            <ion-icon class="icon" name="alert-circle-outline"></ion-icon>
                        </div>
                        <div class="right">
                            <p>Please select image of format (".png", ".jpg", ".jpeg", ".gif", ".tiff") to upload.</p>
                        </div>
                    </div>';
        } elseif (!$size) {
            $msg = '<div class="msg danger-msg">
                        <div class="left">
                            <ion-icon class="icon" name="alert-circle-outline"></ion-icon>
                        </div>
                        <div class="right">
                            <p>Please select image under size of 1gb to upload.</p>
                        </div>
                    </div>';
        } else {

            $get_sql = "SELECT * FROM `news_events_head` WHERE `id` = '$id'";
            $get_res = mysqli_query($conn, $get_sql);
            $data = mysqli_fetch_assoc($get_res);

            $db_file_name = $data['file_name'];

            $db_file_name_arr = explode('#|#', $db_file_name);

            $file_removed = true;

            foreach ($db_file_name_arr as $key => $value) {
                
                $remove_path = 'src/dynamic_src/thumbnail/'.$value;

                if (!unlink($remove_path)) {
                    $file_removed = false;
                    break;
                }
            }

            if ($file_removed) {

                $uploaded = true;
                $file_names_arr = [];

                foreach ($file_name as $key => $value) {
                    $extension = strtolower(pathinfo($value, PATHINFO_EXTENSION));

                    if (strpos($event_head, '\\') || strpos($event_head, '/')) {
                        $file_name = $key.'_@'.$for_name_datetime.'.'.$extension;
        
                    } else {
                        $file_name = $key.'_'.$event_head.'@'.$for_name_datetime.'.'.$extension;

                    }
                    $path = 'src/dynamic_src/thumbnail/'.$file_name;
                    array_push($file_names_arr, $file_name);

                    if (!move_uploaded_file($file_tmp_name[$key], $path)) {
                        $uploaded = false;
                        break;
                    }
                }

                if ($uploaded) {
                    $file_names_string = implode("#|#", $file_names_arr);

                    $update_sql = "UPDATE `news_events_head` SET `event_head` = '$event_head', `file_name` = '$file_names_string', 
                    `datetime` = '$datetime' WHERE `id` = '$id'";
                    $update_res = mysqli_query($conn, $update_sql);
                
                    if ($update_res) {
                        $msg = '<div class="msg success-msg">
                                    <div class="left">
                                        <ion-icon class="icon" name="checkmark-circle-outline"></ion-icon>
                                    </div>
                                    <div class="right">
                                        <p>Event head has been edited.</p>
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
        
    } else {
        
        $update_sql = "UPDATE `news_events_head` SET `event_head` = '$event_head', `datetime` = '$datetime' WHERE `id` = '$id'";
        $update_res = mysqli_query($conn, $update_sql);
    
        if ($update_res) {
            $msg = '<div class="msg success-msg">
                        <div class="left">
                            <ion-icon class="icon" name="checkmark-circle-outline"></ion-icon>
                        </div>
                        <div class="right">
                            <p>Event head has been edited.</p>
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
    <link rel="stylesheet" href="css/news-and-events.css">

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
            <div class="msg-section"></div>
            <div class="section">
                <h1>Add News or Event</h1>
                <div class="actions">
                    <div id="form">
                        <div class="add-event-head">
                            <h2>Add News or Event Head</h2>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <label for="add-head">Add Head</label>
                                <input type="text" name="add-event-head" id="add-head" placeholder="Add Head">
                                <label for="add-file" class="file-label">Add Thumbnail (Size should be 275x170)</label>
                                <input type="file" name="add-file[]" id="add-file" multiple="multiple">
                                <button type="submit" name="add-event-head-submit">Add</button>
                            </form>
                        </div>
                        <div class="edit-event-head">
                            <h2>Edit News or Event Head</h2>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="event-head-id" id="event-head-id">
                                <label for="add-head">Edit Head</label>
                                <input type="text" name="edit-event-head" id="edit-head" placeholder="Edit Head">
                                <label for="edit-file" class="file-label">Edit Thumbnail</label>
                                <input type="file" name="edit-file[]" id="edit-file" multiple="multiple">
                                <button type="submit" name="edit-event-head-submit">Edit</button>
                                <br>
                                <button class="add-head-btn">Add Head</button>
                            </form>
                        </div>
                    </div>
                    <div class="event-head-container">
                        <div class="top-div">
                            <div class="left">
                                <h3>All News and Events</h3>
                            </div>
                            <div class="right">
                                <label for="search-event-head">Search News or Event Head</label>
                                <input type="text" id="search-event-head" placeholder="Search...">
                            </div>
                        </div>
                        <div class="event-heads">
                            <!-- <div class="event-head">
                                <div class="up">
                                    <p class="date">Added on: 14 Aug 22</p>
                                    <a href="add-bunch.php?event-head-id='.$data['id'].'">
                                        <i class="plus fa-solid fa-plus"></i>
                                    </a>
                                    <i class="edit-head fa-regular fa-pen-to-square" data-id="'.$data['id'].'"></i>
                                    <i class="delete-head fa-regular fa-trash-can" data-id="'.$data['id'].'"></i>
                                    <i class="angle fa-solid fa-angle-down"></i>
                                        <ul>
                                            <li>
                                                <a href="edit-bunch.php?bunch-id='.$ul_data['id'].'">
                                                    <i class="edit fa-regular fa-pen-to-square"></i>
                                                </a>
                                                <i data-id="'.$ul_data['id'].'" class="delete fa-regular fa-trash-can"></i>
                                                dd
                                            </li>
                                            <li>
                                                <a href="edit-bunch.php?bunch-id='.$ul_data['id'].'">
                                                    <i class="edit fa-regular fa-pen-to-square"></i>
                                                </a>
                                                <i data-id="'.$ul_data['id'].'" class="delete fa-regular fa-trash-can"></i>
                                                dd
                                            </li>
                                        </ul>
                                <div class="not-div"></div>
                                </div>
                                <div class="down">
                                    <img src="src/static_images/admin-pic.png" alt="">
                                    <h3>14 </h3>
                                </div>
                            </div> -->
                        </div>
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

    $(document).on('click', '.add-head-btn', function (e) {
        e.preventDefault()
        $('.add-event-head').show()
        $('.edit-event-head').hide()
    })

    $(document).on('click', '.angle', function () {
        $(this).next().toggle()
    })
    // $('.head-main-container').click(function () {
    //     $('.event-head-container ul').hide()
    // })

    $('body').click(function(evt){    
        if(evt.target.id == "ul" || evt.target.id == "angle") {
            return;
        }
        if($(evt.target).closest('#ul, #angle').length) {
            return;             
        }
        $('.event-head-container ul').hide()
    });
    
    function load_heads() {
        $.ajax({
            url: "processor/event-head/event-head-fetcher.php",
            type: "POST",
            data: {
                action: "on-load"
            },
            success: function (data) {
                // console.log(data);
                $('.event-heads').html(data)
                
                if (data == 0) {
                    $('.event-heads').html('No Event Head Found!')
                }
            }
        })
    }
    load_heads()

    $('#search-event-head').keyup(function () {
        var value = $('#search-event-head').val()

        $.ajax({
            url: "processor/event-head/event-head-fetcher.php",
            type: "POST",
            data: {
                action: "on-search",
                search_string: value
            },
            success: function (data) {
                // console.log(data);
                $('.event-heads').html(data)

                if (data == 0) {
                    $('.event-heads').html('No Event Head Found!')
                }
            }
        })
    })

    $(document).on('click', '.edit-head', function () {
        $('.add-event-head').hide()
        $('.edit-event-head').show()

        $('html, body').animate({
            scrollTop: $("#form").offset().top
        }, 200);

        var text = $(this).parent().next()[0].children[1].innerHTML
        var event_head_id = $(this).data('id')
        console.log(event_head_id);
        $('#edit-head').val(text)
        $('#event-head-id').val(event_head_id)

    })

    $(document).on('click', '.delete-head', function () {
        var id = $(this).data('id')        

        $.ajax({
            url: 'processor/event-head/event-head-deleter.php',
            type: "POST",
            data: {
                id: id
            },
            success: function (data) {
                console.log(data);
                if (data == 1) {
                    load_heads()
                }
            }
        })
    })
    
    $(document).on('click', '.delete', function () {
        var id = $(this).data('id')
        
        $.ajax({
            url: 'processor/bunch/bunch-deleter.php',
            type: 'POST',
            data: {
                id: id
            },
            success: function (data) {
                console.log(data);
                if (data == 0) {
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
                                    <p>Bunch has been deleted.</p>
                                </div>
                            </div>`;
                    load_heads()
                }
                $('.msg-section').html(msg)
            }
        })
    })

</script>
</html>