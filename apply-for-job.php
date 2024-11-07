<?php

require "_config.php";
date_default_timezone_set("Asia/Karachi");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mail_sender/vendor/autoload.php';

$mail = new PHPMailer(true);

$msg = "";


if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $father_name = mysqli_real_escape_string($conn, $_POST['father-name']);
    $primary_contact_number = mysqli_real_escape_string($conn, $_POST['primary-contact-number']);
    $other_contact_number = mysqli_real_escape_string($conn, $_POST['other-contact-number']);
    $whatsapp_number = mysqli_real_escape_string($conn, $_POST['whatsapp-number']);
    $email_address = mysqli_real_escape_string($conn, $_POST['email-address']);
    $residential_address = mysqli_real_escape_string($conn, $_POST['residential-address']);
    $previous_schools = mysqli_real_escape_string($conn, $_POST['previous-schools']);

    $datetime = date("H:i - d M y");
    // Checkboxes and Radios 
    if (isset($_POST['matric'])) {
        $matric = $_POST['matric'];
    } else {
        $matric = 'User did not fill this field.';
    }
    if (isset($_POST['intermediate'])) {
        $intermediate = $_POST['intermediate'];
    } else {
        $intermediate = 'User did not fill this field.';
    }
    if (isset($_POST['graduation'])) {
        $graduation = $_POST['graduation'];
    } else {
        $graduation = 'User did not fill this field.';
    }
    if (isset($_POST['masters'])) {
        $masters = $_POST['masters'];
    } else {
        $masters = 'User did not fill this field.';
    }
    if (isset($_POST['professional-training'])) {
        $professional_training = $_POST['professional-training'];
    } else {
        $professional_training = 'User did not fill this field.';
    }
    if (isset($_POST['subjects'])) {
        $subjects = $_POST['subjects'];                                 // Array form
        $subjects_string =  implode(",",$subjects);
    } else {
        $subjects_string = 'User did not fill this field.';
    }
    if (isset($_POST['section-of-interest'])) {
        $section_of_interest = $_POST['section-of-interest'];           // Array form
        $section_of_interest_string =  implode(",",$section_of_interest);
    } else {
        $section_of_interest_string = "User did not fill this field.";
    }
    if (isset($_POST['timings'])) {
        $timings = $_POST['timings'];
    } else {
        $timings = "User did not fill this field.";
    }
    if (isset($_POST['experience'])) {
        $experience = $_POST['experience'];
    } else {
        $experience = "User did not fill this field.";
    }
    $qualifications = mysqli_real_escape_string($conn, $_POST['qualifications']);
    $other_detail = mysqli_real_escape_string($conn, $_POST['other-detail']);


    if ($name == "" || $father_name == "" || $primary_contact_number == "" || $residential_address == "") {
        $msg = '<div class="msg danger-msg">
                    <div class="left">
                        <ion-icon class="icon" name="alert-circle-outline"></ion-icon>
                    </div>
                    <div class="right">
                        <p><b>Name</b>, <b>Father\'s Name</b>, <b>Primary Contact Number</b> and <b>Residential Address</b> are Compulsory.</p>
                    </div>
                </div>';
    } else {
    
        $insert_sql = "INSERT INTO `job_applications` (`candidate_name`, `father_name`, `primary_number`, `other_number`, `whatsapp_number`, 
                                    `email_address`, `address`, `prev_school`, `matric`, `inter`, `graduation`, `masters`, `professional_training`, 
                                    `qualifications`, `subjects_of_interest`, `section_of_interest`, `timings`, `experience`, `other_detail`, 
                                    `datetime`)
                                    VALUES ('$name', '$father_name', '$primary_contact_number', '$other_contact_number', '$whatsapp_number', 
                                    '$email_address', '$residential_address', '$previous_schools', '$matric', '$intermediate', 
                                    '$graduation', '$masters', '$professional_training', '$qualifications', '$subjects_string', 
                                    '$section_of_interest_string', '$timings', '$experience', '$other_detail', '$datetime')";
        $insert_res = mysqli_query($conn, $insert_sql);

        if ($insert_res) {
            $msg = '<div class="msg success-msg">
                        <div class="left">
                            <ion-icon class="icon" name="checkmark-circle-outline"></ion-icon>
                        </div>
                        <div class="right">
                            <p>Your application has been submitted. We will contact you through your contact numbers, whatsapp number or email address.</p>
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
                    <b style="font-size:20px;"><q>'.$name.'</q></b> sent you a job application. Please check it on Admin Panel.
                    
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
}

$datetime = date("Y-m-d H:i:s");
// 2023-01-29 05:10:48
// echo $datetime;
$modDate =  date ('h:i a <b>||</b> d M, Y', strtotime($datetime));
echo $modDate;


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
    <link rel="stylesheet" href="css/apply-for-job.css">
    <link rel="shortcut icon" href="src/logo.png" type="image/x-icon">
    <title>Apply for Job - Shaheen Children Academy</title>
</head>
<body>
<div class="head-main-container">
    <?php include "_header.php"; ?>
    <?php echo $msg; ?>
    <section>
        <h1 class="head">Job Application</h1>
        <form method="post">
            <div class="input-div name-div">
                <label class="labels" for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter your Name">
            </div>
            <div class="input-div father-name-div">
                <label class="labels" for="father-name">Father's Name</label>
                <input type="text" name="father-name" id="father-name" placeholder="Enter your Father's Name">
            </div>
            <div class="input-div primary-contact-number-div">
                <label class="labels" for="primary-contact-number">Primary Contact Number</label>
                <input type="number" name="primary-contact-number" id="primary-contact-number" placeholder="Enter your Primary Contact Number">
            </div>
            <div class="input-div other-contact-number-div">
                <label class="labels" for="other-contact-number">Other Contact Number</label>
                <input type="number" name="other-contact-number" id="other-contact-number" placeholder="Enter your Other Contact Number">
            </div>
            <div class="input-div whatsapp-number-div">
                <label class="labels" for="whatsapp-number">Whatsapp Number (If any)</label>
                <input type="number" name="whatsapp-number" id="whatsapp-number" placeholder="Enter your Whatsapp Number">
            </div>
            <div class="input-div email-address-div">
                <label class="labels" for="email-address">Email Address (If any)</label>
                <input type="text" name="email-address" id="email-address" placeholder="Enter your Email Address">
            </div>
            <div class="input-div residential-address-div">
                <label class="labels" for="residential-address">Complete Residential Address</label>
                <input type="text" name="residential-address" id="residential-address" placeholder="Enter your Complete Residential Address">
            </div>
            <div class="skip-div"></div>
            <div class="input-div previous-schools-div">
                <label class="labels" for="previous-schools">Previous schools Attended (Please list all experience if applies)</label>
                <textarea name="previous-schools" id="previous-schools" placeholder="Enter your Previous schools Attended" cols="30" rows="6"></textarea>
            </div>
            <div class="skip-div"></div>
            <div class="input-div matric-div checkbox-div">
                <h6 class="labels">Matriculation</h6>
                <div>
                    <input type="radio" name="matric" value="Science Group" id="matric-science-group">
                    <label for="matric-science-group">Science Group</label>
                </div>
                <div>
                    <input type="radio" name="matric" value="Arts Group" id="matric-arts-group">
                    <label for="matric-arts-group">Arts Group</label>
                </div>
            </div>
            <div class="input-div intermediate-div checkbox-div">
                <h6 class="labels">Intermediate</h6>
                <div>
                    <input type="radio" name="intermediate" value="Science Group" id="intermediate-science-group">
                    <label for="intermediate-science-group">Science Group</label>
                </div>
                <div>
                    <input type="radio" name="intermediate" value="Arts Group" id="intermediate-arts-group">
                    <label for="intermediate-arts-group">Arts Group</label>
                </div>
                <div>
                    <input type="radio" name="intermediate" value="Commerce Group" id="intermediate-commerce-group">
                    <label for="intermediate-commerce-group">Commerce Group</label>
                </div>
                <div>
                    <input type="radio" name="intermediate" value="Home Economics" id="intermediate-home-economics">
                    <label for="intermediate-home-economics">Home Economics</label>
                </div>
                <div>
                    <input type="radio" name="intermediate" value="Others" id="intermediate-others">
                    <label for="intermediate-others">Others</label>
                </div>
            </div>
            <div class="input-div graduation-div checkbox-div">
                <h6 class="labels">Graduation</h6>
                <div>
                    <input type="radio" name="graduation" value="Science Group" id="graduation-science-group">
                    <label for="graduation-science-group">Science Group</label>
                </div>
                <div>
                    <input type="radio" name="graduation" value="Arts Group" id="graduation-arts-group">
                    <label for="graduation-arts-group">Arts Group</label>
                </div>
                <div>
                    <input type="radio" name="graduation" value="Commerce Group" id="graduation-commerce-group">
                    <label for="graduation-commerce-group">Commerce Group</label>
                </div>
                <div>
                    <input type="radio" name="graduation" value="Home Economics" id="graduation-home-economics">
                    <label for="graduation-home-economics">Home Economics</label>
                </div>
                <div>
                    <input type="radio" name="graduation" value="Others" id="graduation-others">
                    <label for="graduation-others">Others</label>
                </div>
            </div>
            <div class="input-div masters-div checkbox-div">
                <h6 class="labels">Masters</h6>
                <div>
                    <input type="radio" name="masters" value="Science Group" id="masters-science-group">
                    <label for="masters-science-group">Science Group</label>
                </div>
                <div>
                    <input type="radio" name="masters" value="Arts Group" id="masters-arts-group">
                    <label for="masters-arts-group">Arts Group</label>
                </div>
                <div>
                    <input type="radio" name="masters" value="Commerce Group" id="masters-commerce-group">
                    <label for="masters-commerce-group">Commerce Group</label>
                </div>
                <div>
                    <input type="radio" name="masters" value="Home Economics" id="masters-home-economics">
                    <label for="masters-home-economics">Home Economics</label>
                </div>
                <div>
                    <input type="radio" name="masters" value="Others" id="masters-others">
                    <label for="masters-others">Others</label>
                </div>
            </div>
            <div class="input-div professional-training-div checkbox-div">
                <h6 class="labels">Professional Training</h6>
                <div>
                    <input type="radio" name="professional-training" value="B.Ed" id="professional-training-b.ed">
                    <label for="professional-training-b.ed">B.Ed</label>
                </div>
                <div>
                    <input type="radio" name="professional-training" value="M.Ed" id="professional-training-m.ed">
                    <label for="professional-training-m.ed">M.Ed</label>
                </div>
                <div>
                    <input type="radio" name="professional-training" value="Montessori Diploma" id="professional-training-montessori-diploma">
                    <label for="professional-training-montessori-diploma">Montessori Diploma</label>
                </div>
                <div>
                    <input type="radio" name="professional-training" value="English Language Courses" id="professional-training-english-language-courses">
                    <label for="professional-training-english-language-courses">English Language Courses</label>
                </div>
                <div>
                    <input type="radio" name="professional-training" value="Computer Training Courses" id="professional-training-computer-training-courses">
                    <label for="professional-training-computer-training-courses">Computer Training Courses</label>
                </div>
                <div>
                    <input type="radio" name="professional-training" value="Others" id="professional-training-others">
                    <label for="professional-training-others">Others</label>
                </div>
            </div>
            <div class="skip-div"></div>
            <div class="input-div qualifications-div">
                <label class="labels" for="qualifications">Qualifications. You can tell more in this section if you want to (Optional Question)</label>
                <textarea name="qualifications" id="qualifications" placeholder="Enter your Qualifications" cols="30" rows="6"></textarea>
            </div>
            <div class="skip-div"></div>
            <div class="input-div subjects-div checkbox-div">
                <h6 class="labels">Subjects of Interest (Check all that apply)</h6>
                <div>
                    <input type="checkbox" name="subjects[]" value="English" id="subjects-eng">
                    <label for="subjects-eng">English</label>
                </div>
                <div>
                    <input type="checkbox" name="subjects[]" value="Mathematics" id="subjects-math">
                    <label for="subjects-math">Mathematics</label>
                </div>
                <div>
                    <input type="checkbox" name="subjects[]" value="Science" id="subjects-sci">
                    <label for="subjects-sci">Science</label>
                </div>
                <div>
                    <input type="checkbox" name="subjects[]" value="S.St" id="subjects-sst">
                    <label for="subjects-sst">S.St</label>
                </div>
                <div>
                    <input type="checkbox" name="subjects[]" value="Urdu" id="subjects-urdu">
                    <label for="subjects-urdu">Urdu</label>
                </div>
                <div>
                    <input type="checkbox" name="subjects[]" value="Islamiyat" id="subjects-isl">
                    <label for="subjects-isl">Islamiyat</label>
                </div>
                <div>
                    <input type="checkbox" name="subjects[]" value="Computer" id="subjects-comp">
                    <label for="subjects-comp">Computer</label>
                </div>
                <div>
                    <input type="checkbox" name="subjects[]" value="Sindhi" id="subjects-sindhi">
                    <label for="subjects-sindhi">Sindhi</label>
                </div>
                <div>
                    <input type="checkbox" name="subjects[]" value="English Language" id="subjects-eng-lang">
                    <label for="subjects-eng-lang">English Language</label>
                </div>
                <div>
                    <input type="checkbox" name="subjects[]" value="Arts and Crafts" id="subjects-art">
                    <label for="subjects-art">Arts and Crafts</label>
                </div>
                <div>
                    <input type="checkbox" name="subjects[]" value="Others" id="subjects-other">
                    <label for="subjects-other">Others</label>
                </div>
            </div>
            <div class="input-div section-of-interest-div checkbox-div">
                <h6 class="labels">Section of Interest</h6>
                <div>
                    <input type="checkbox" name="section-of-interest[]" value="Montessori" id="section-of-interest-montessori">
                    <label for="section-of-interest-montessori">Montessori</label>
                </div>
                <div>
                    <input type="checkbox" name="section-of-interest[]" value="Primary (Grade 1 to 5)" id="section-of-interest-primary">
                    <label for="section-of-interest-primary">Primary (Grade 1 to 5)</label>
                </div>
                <div>
                    <input type="checkbox" name="section-of-interest[]" value="Secondary (Grade 6 to 10)" id="section-of-interest-secondary">
                    <label for="section-of-interest-secondary">Secondary (Grade 6 to 10)</label>
                </div>
                <div>
                    <input type="checkbox" name="section-of-interest[]" value="Administration/Management" id="section-of-interest-management">
                    <label for="section-of-interest-management">Administration/Management</label>
                </div>
            </div>
            <div class="input-div timings-div checkbox-div">
                <h6 class="labels">Timings</h6>
                <div>
                    <input type="radio" name="timings" value="Full Time" id="timings-full-time">
                    <label for="timings-full-time">Full Time</label>
                </div>
                <div>
                    <input type="radio" name="timings" value="Part Time" id="timings-part-time">
                    <label for="timings-part-time">Part Time</label>
                </div>
                <div>
                    <input type="radio" name="timings" value="Casual" id="timings-casual">
                    <label for="timings-casual">Casual</label>
                </div>
                <div>
                    <input type="radio" name="timings" value="Volunteer" id="timings-volunteer">
                    <label for="timings-volunteer">Volunteer</label>
                </div>
            </div>
            <div class="input-div experience-div checkbox-div">
                <h6 class="labels">Experience</h6>
                <div>
                    <input type="radio" name="experience" value="Less than 1 year" id="experience-less-1-year">
                    <label for="experience-less-1-year">Less than 1 year</label>
                </div>
                <div>
                    <input type="radio" name="experience" value="1 to 3 years" id="experience-1to3-year">
                    <label for="experience-1to3-year">1 to 3 years</label>
                </div>
                <div>
                    <input type="radio" name="experience" value="More than 3 years" id="experience-more-3-year">
                    <label for="experience-more-3-year">More than 3 years</label>
                </div>
            </div>
            <div class="input-div other-detail-div">
                <label class="labels" for="other-detail">Any other details you want to share with us, please do write in this section.</label>
                <textarea name="other-detail" id="other-detail" placeholder="Enter Other Detail" cols="30" rows="6"></textarea>
            </div>
            <div class="skip-div"></div>
            <div class="btn">
                <span>
                    <button class="submit-btn" name="submit">Submit</button>
                    <img src="src/loading.gif" alt="Loading" class="loading-gif">
                </span>
                <button class="clr-form-btn">Reset form</button>
            </div>
        </form>
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
    var inputs = $('input[type=text]');
    var textarea = $('textarea');
    var radios = $('input[type=radio]');
    var checkboxes = $('input[type=checkbox]');

    $('.clr-form-btn').click(function (e) {
        e.preventDefault();

        inputs.each(function (index, value) {
            console.log(value);
            $(value).val('');
        });
        textarea.each(function (index, value) {
            console.log(value);
            $(value).val('');
        });
        radios.each(function (index, value) {
            console.log(value);
            $(value).prop('checked', false);
        });
        checkboxes.each(function (index, value) {
            console.log(value);
            $(value).prop('checked', false);
        });
        

    })

    $(".submit-btn").click(function () {
        $('.loading-gif').show()
    })
</script>
</html>