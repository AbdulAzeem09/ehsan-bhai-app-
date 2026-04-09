<?php
//echo json_encode($_POST);exit;
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
    'user' => getenv('DB_USER'),      // Database username
    'pass' => getenv('DB_PASS'),          // Database password
    'db'   => getenv('DB_NAME'),  // Database name
    'host' => getenv('DB_HOST')  // Database host
];
$conn = mysqli_connect($sql_details['host'], $sql_details['user'], $sql_details['pass'], $sql_details['db']);
$table = 'spjobboard'; 
$primaryKey = 'idspPostings'; 
$columns = [
    ['db' => 'spPostingTitle', 'dt' => 0],
    ['db' => 'spPostingDate', 'dt' => 1],
    ['db' => 'idspPostings', 'dt' => 2],
    ['db' => 'spPostingDate', 'dt' => 3],
    ['db' => 'spPostingDate', 'dt' => 4],
    ['db' => 'spPostingVisibility', 'dt' => 5],
];
$currentDate = date('Y-m-d');
$where = " spProfiles_idspProfiles = " . $_SESSION['pid'] . "  ".( isset($_REQUEST['type'])&&$_REQUEST['type']=='draft' ? "AND spPostingVisibility = 0" : "AND spPostingVisibility in (-1,1) " ) . " AND spPostingExpDt >= '$currentDate'"; 

$data = SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null, $where);
foreach ($data['data'] as &$row) {
    if($row[5] == -1){
       $text = '<div style="float:left;cursor:pointer;padding:0px 4px;" title="Pause" class="link" data-bs-toggle="modal" data-bs-target="#anc-view" onclick="pauseJob('.$row[2].')">
                        <span class="img">
                            <img src="./images/pause.svg" alt="">
                        </span>
                    </div>';
    }else{
        $text = '<div style="float:left;cursor:pointer;padding:0px 4px;" title="Make Live" class="link" data-bs-toggle="modal" data-bs-target="#anc-view"  onclick="activateJob('.$row[2].')">
                    <span class="img">
                        <img src="./images/pause.svg" alt="">
                    </span>
                </div>';
    }
    $row[0] = '<a href="/job-board/job-detail.php?postid='.$row[2].'">'.$row[0].'</a>';
    $row[3] = '<a href="view_applicant.php?postId='.$row[2].'">'.mysqli_num_rows(mysqli_query($conn, "SELECT * FROM job_apply WHERE job_id = ".$row[2])).'</a>';
    $row[4] = ( $row[5] == -1 ) ? '<span class="status">Active</span>' : '<span style="background-color:grey" class="status">Paused</span>';
    $row[5] = '<div style="float:left;cursor:pointer;padding:0px 4px;" title="View Applicants" class="link" data-bs-toggle="modal" data-bs-target="#anc-view">
                <a href="'.$BaseUrl.'/job-employee/view_applicant.php?postId='.$row[2].'">
                <span class="img">
                    <img src="./images/view.svg" alt="">
                </span>
                </a>
            </div>
            '.$text.'
            <div style="float:left;cursor:pointer;padding:0px 4px;" title="Edit" class="link" data-bs-toggle="modal" data-bs-target="#anc-view">
                <a href="'.$BaseUrl.'/job-employee/post-a-job.php?postId='.$row[2].'">
                <span class="img">
                    <img src="./images/edit.svg" alt="">
                </span>
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