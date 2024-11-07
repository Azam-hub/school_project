<?php
require "_config.php";

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
    <link rel="stylesheet" href="css/job-application.css">

    <link rel="shortcut icon" href="src/static_images/logo.png" type="image/x-icon">
    
    <title>Admin Panel - Shaheen Children Academy</title>
</head>
<body>
<div class="head-main-container">
    <div class="main-container">
        <?php include '_sidebar.php'; ?>
        <div class="main-content">
            <?php include '_head.php'; ?>
            <div class="section">
                <div class="head-search-div">
                    <h1>Job Applications</h1>
                    <div class="search-div">
                        <label for="search">Search Job Application</label>
                        <input type="text" id="search" placeholder="Search...">
                    </div>
                </div>
                <div class="actions">
                    <div class="quick-access">
                        <h2>Quick Access</h2>
                        <div class="links">
                            <?php
                            $get_sql = "SELECT * FROM `job_applications` ORDER BY `id` DESC";
                            $get_res = mysqli_query($conn, $get_sql);
                            $get_rows = mysqli_num_rows($get_res);
                            
                            if ($get_rows > 0) {
                                for ($i=0; $i < $get_rows; $i++) {
                                    $data = mysqli_fetch_assoc($get_res);

                                    echo '<a href="#'.$data['id'].'">'.$data['candidate_name'].'</a>';
                                }
                            } else {
                                echo "No job applications yet";
                            }
                            ?>
                            <!-- <a href="#">Azam</a>
                            <a href="#">Azam</a>
                            <a href="#">Azam</a>
                            <a href="#">Azam</a>
                            <a href="#">Azam</a> -->
                        </div>
                    </div>
                    <div class="applications">
                        <?php
                        $get_sql = "SELECT * FROM `job_applications` ORDER BY `id` DESC";
                        $get_res = mysqli_query($conn, $get_sql);
                        $get_rows = mysqli_num_rows($get_res);

                        if ($get_rows > 0) {
                            for ($i=0; $i < $get_rows; $i++) {

                                $data = mysqli_fetch_assoc($get_res);
                                
                                $subjects_arr = explode(",", $data['subjects_of_interest']);
                                $section_arr = explode(",", $data['section_of_interest']);

                                if (strlen($data['candidate_name']) > 18) {
                                    $candidate_name = substr($data['candidate_name'], 0, 15).'...';
                                } else {
                                    $candidate_name = $data['candidate_name'];
                                }

                                // $datetime = explode('_', $data['datetime']);

                                // $date = $datetime

                                echo '
                                <div class="application" id="'.$data['id'].'">
                                    <span class="datetime">Applied at : <b>'.$data['datetime'].'</b></span>
                                    <div class="application-head">
                                        <h1>Job Application of <q>'.$candidate_name.'</q></h1>
                                        <button class="del-btn" id="'.$data['id'].'">Delete</button>
                                    </div>
                                    <div class="infos">
                                        <span><b>Name : </b><br>
                                            '.$data['candidate_name'].'
                                        </span>
                                        <span><b>Father\'s Name : </b><br>
                                            '.$data['father_name'].'
                                        </span>
                                        <span><b>Primary Contact Number : </b><br>
                                            '.$data['primary_number'].'
                                        </span>
                                        <span><b>Other Contact Number : </b><br>
                                            '.$data['other_number'].'
                                        </span>
                                        <span><b>Whatsapp Number : </b><br>
                                            '.$data['whatsapp_number'].'
                                        </span>
                                        <span><b>Email Address : </b><br>
                                            '.$data['email_address'].'
                                        </span>
                                        <span><b>Residential Address : </b><br>
                                            '.$data['address'].'
                                        </span>
                                        <span><b>Previous schools Attended : </b><br>
                                            '.$data['prev_school'].'
                                        </span>
                                        <span><b>Qualifications : </b><br>
                                            '.$data['qualifications'].'
                                        </span>
                                        <span><b>Matriculation : </b><br>
                                            '.$data['matric'].'
                                        </span>
                                        <span><b>Intermediate : </b><br>
                                            '.$data['inter'].'
                                        </span>
                                        <span><b>Graduation : </b><br>
                                            '.$data['graduation'].'
                                        </span>
                                        <span><b>Masters : </b><br>
                                            '.$data['masters'].'
                                        </span>
                                        <span><b>Professional Training : </b><br>
                                            '.$data['professional_training'].'
                                        </span>
                                        <span><b>Subjects of Interest : </b><br>
                                            <ul>
                                        ';

                                        foreach ($subjects_arr as $value) {
                                            echo "<li>$value</li>";
                                        }

                                        echo '</ul>
                                        </span>

                                        <span><b>Section of Interest : </b><br>
                                            <ul>
                                        ';

                                        foreach ($section_arr as $value) {
                                            echo "<li>$value</li>";
                                        }

                                        echo '</ul>
                                        </span>
                                        <span><b>Timings : </b><br>
                                            '.$data['timings'].'
                                        </span>
                                        <span><b>Experience : </b><br>
                                            '.$data['experience'].'
                                        </span>
                                        <span><b>Other details : </b><br>
                                            '.$data['other_detail'].'
                                        </span>
                                    </div>
                                </div>
                                ';
                            }
                        } else {
                            echo "No job applications yet.";
                        }                    
                        ?>
                        <!-- <div class="application">
                            <div class="application-head">
                                <h1>Job Application of <q>Azam</q></h1>
                                <button>Delete</button>
                            </div>
                            <div class="infos">
                                <span><b>Name : </b><br>
                                    Azam
                                </span>
                                <span><b>Father's Name : </b><br>
                                    Azam
                                </span>
                                <span><b>Primary Contact Number : </b><br>
                                    03101120402
                                </span>
                                <span><b>Other Contact Number : </b><br>
                                    03101120402
                                </span>
                                <span><b>Email Address : </b><br>
                                    azam78454@gmail.com
                                </span>
                                <span><b>Residential Address : </b><br>
                                    House#11 (near choti market), Block#11, Area#37-B, Noor Manzil, Landhi#1, Karachi.
                                </span>
                                <span><b>Previous schools Attended : </b><br>
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus similique sint magnam dolor in provident perspiciatis consectetur, placeat non incidunt? Dicta quas ipsa accusantium sapiente, ut beatae nostrum voluptates incidunt!
                                </span>
                                <span><b>Qualifications : </b><br>
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sunt aliquid inventore corrupti aliquam libero facilis ipsum? Ducimus, ad. Labore reiciendis commodi voluptates incidunt, at fugiat sed cum voluptatem nesciunt aspernatur.
                                </span>
                                <span><b>Matriculation : </b><br>
                                    Azam
                                </span>
                                <span><b>Intermediate : </b><br>
                                    Azam
                                </span>
                                <span><b>Graduation : </b><br>
                                    Azam
                                </span>
                                <span><b>Masters : </b><br>
                                    Azam
                                </span>
                                <span><b>Professional Training : </b><br>
                                    Azam
                                </span>
                                <span><b>Subjects of Interest : </b><br>
                                    <ul>
                                        <li>azam</li>
                                        <li>azam</li>
                                        <li>azam</li>
                                    </ul>
                                </span>
                                <span><b>Section of Interest : </b><br>
                                    Azam
                                </span>
                                <span><b>Timings : </b><br>
                                    Azam
                                </span>
                                <span><b>Experience : </b><br>
                                    Azam
                                </span>
                                <div class="skip"></div>
                                <span><b>Other details : </b><br>
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vitae sint provident sunt, veritatis incidunt voluptate, porro placeat obcaecati voluptatibus fugit accusantium, quas deserunt sit architecto id illum commodi inventore iure.
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
    $(document).on('click', '.del-btn', function () {
        var id = this.id

        $.ajax({
            url : 'processor/application-action/application-deleter.php',
            type : 'POST',
            data : {
                id : id
            },
            success : function (data) {
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
            url : 'processor/application-action/application-search.php',
            type : 'POST',
            data : {
                search : search
            },
            success : function (data) {
                // console.log(data);
                $('.applications').html(data)
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