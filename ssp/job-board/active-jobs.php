<?php
//echo json_encode($_POST);exit;
session_start();
include('../../univ/baseurl.php');
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
loadEnv('../../.env');
require('../ssp.class.php');
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
    ['db' => 'spPostingDate', 'dt' => 5],
];
$where = " spProfiles_idspProfiles = " . $_REQUEST['id'] . " and spPostingVisibility = -1 "; // Add your custom WHERE clause
$data = SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null, $where);

foreach ($data['data'] as &$row) {
    $row[0] = '<a href="'.$BaseUrl.'/job-board/job-detail.php?postid='.$row[2].'">'.$row[0].'</a>';
    $row[1] = date('Y-m-d H:i', strtotime($row[1]));
    $row[2] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM job_apply WHERE job_id = ".$row[2]));
    $row[3] = '<a href="'.$BaseUrl.'/job-employee/view_applicant.php?postId='.$row[2].'">View Job</a>';
}

echo json_encode(
    $data
);