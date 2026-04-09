<?php
session_start();
function loadEnv($file = '../.env') {
    if (!file_exists($file)) {
        throw new Exception('.env file not found');
    }
    $envVars = parse_ini_file($file);
    if (!$envVars) {
        throw new Exception('Error parsing .env file');
    }
    foreach ($envVars as $key => $value) {
        putenv("$key=$value");
    }
}

loadEnv('../../.env');
require('../ssp.class.php');
$sql_details = [
    'user' => getenv('DB_USER'),      // Database username
    'pass' => getenv('DB_PASS'),          // Database password
    'db'   => getenv('DB_NAME'),  // Database name
    'host' => getenv('DB_HOST')  // Database host
];
$table = 'job_apply'; 
$primaryKey = 'id'; 
$columns = [
    ['db' => 'myprofile', 'dt' => 0],
    ['db' => 'resume_url', 'dt' => 1],
    ['db' => 'desired_salary', 'dt' => 2],
    ['db' => 'coverletter_title', 'dt' => 3],
    ['db' => 'id', 'dt' => 4], 
    ['db' => 'pid', 'dt' => 5] 
];
$where = " job_id = " . $_REQUEST['postId'] . " and status = 'active' "; // Add your custom WHERE clause
$data = SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null, $where);

foreach ($data['data'] as &$row) {
    $row[0] = '<a href="/friends/?profileid=' . $row[5] . '" target="_blank">'.$row[0].'</a>';
    $row[1] = '<a href="' . $row[1] . '" target="_blank">View Resume</a>';
    $row[3] = '<a href="../ssp/job-employee/download-cover-letter.php?id='.$row[4].'">Download Cover Letter</a>';
    $row[4] = '<img src="./images/dot-2.svg" alt="" class="dot three-dot-button" onclick="threeDot()">
                <div class="more-links" id="three-dot" style="display: none;">
                    <div class="link view-details-button" id="'.$row[4].'"  data-bs-toggle="modal" data-bs-target="#anc-view">
                        <span class="img">
                            <img src="./images/view.svg" alt="">
                        </span>
                        <span>View Applicants Details</span>
                    </div>
                    <a class="link" href="/job-employee/view_applicant.php?postId='.$_REQUEST['postId'].'&applicantId='.$row[4].'&short=true">
                        <span>Short List Applicant</span>
                    </a>
                </div>';
}

echo json_encode(
    $data
);