<?php
session_start();
include('../univ/baseurl.php');
function loadEnv($file = '.env') {
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
loadEnv('../.env');
require('ssp.class.php');

$sql_details = [
    'user' => getenv('DB_USER'), // Database username
    'pass' => getenv('DB_PASS'), // Database password
    'db'   => getenv('DB_NAME'), // Database name
    'host' => getenv('DB_HOST')  // Database host
];

$conn = mysqli_connect($sql_details['host'], $sql_details['user'], $sql_details['pass'], $sql_details['db']);

$table = 'spjobboard';
$primaryKey = 'idspPostings';   
$columns = [
    ['db' => 'spPostingTitle', 'dt' => 0],
    ['db' => 'spPostingDate', 'dt' => 1],
    ['db' => 'idspPostings', 'dt' => 2],   
];

$currentDate = date('Y-m-d');
$where = " spuser_idspuser = " . $_SESSION['uid']. " AND spPostingClosing < '$currentDate'"; // Add your custom WHERE clause
$data = SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null, $where, null, 'ORDER BY idspPostings DESC');

foreach ($data['data'] as &$row) {
    $row[3] = '<a href="view_applicant.php?postId='.$row[2].'">'.mysqli_num_rows(mysqli_query($conn, "SELECT * FROM job_apply WHERE job_id = ".$row[2])).'</a>';
    $row[4] = '<div style="float:left;cursor:pointer;padding:0px 4px;" title="View Applicants" class="link" data-bs-toggle="modal" data-bs-target="#anc-view">
            <a href="'.$BaseUrl.'/job-employee/view_applicant.php?postId='.$row[2].'">
            <span class="img">
                <img src="./images/view.svg" alt="">
            </span>
            </a>
        </div>
        <div style="float:left;cursor:pointer;padding:0px 4px;" title="Pause" class="link" data-bs-toggle="modal" data-bs-target="#anc-view">
            <span class="img">
                <img src="./images/pause.svg" alt="">
            </span>
        </div>
        <div style="float:left;cursor:pointer;padding:0px 4px;" title="Edit" class="link" data-bs-toggle="modal" data-bs-target="#anc-view">
            <a href="'.$BaseUrl.'/job-employee/post-a-job.php?postId='.$row[2].'">
            <span class="img">
                <img src="./images/edit.svg" alt="">
            </span>
            <span></span>
            </a>
        </div>
        <div style="float:left;cursor:pointer;padding:0px 4px;" title="Delete" class="link" onclick="deleteJob('.$row[2].')">
            <span class="img" >
                <img src="./images/delete.svg" alt="">
            </span>
        </div>';
    $row[2] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `job_apply` WHERE `status` = 'active' AND `sort_listed` = 1 AND `job_id` = ".$row[2]));

}

echo json_encode(
    $data
);