<?php

require "../../_config.php";

$search = $_POST['search'];

$get_sql = "SELECT * FROM `job_applications` WHERE 
(`candidate_name` LIKE '%$search%' OR `father_name` LIKE '%$search%' OR `primary_number` LIKE '%$search%' OR `email_address` LIKE '%$search%') 
ORDER BY `id` DESC";

$get_res = mysqli_query($conn, $get_sql);
$get_rows = mysqli_num_rows($get_res);

if ($get_rows > 0) {
    $output = "";
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

        $output .= '
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
                    $output .= "<li>$value</li>";
                }

                $output .= '</ul>
                </span>

                <span><b>Section of Interest : </b><br>
                    <ul>
                ';

                foreach ($section_arr as $value) {
                    $output .= "<li>$value</li>";
                }

                $output .= '</ul>
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
    echo $output;
} else {
    echo "No job applications found like <b>".$search."</b>";
}

?>