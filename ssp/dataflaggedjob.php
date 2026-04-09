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
    'user' => getenv('DB_USER'),      // Database username
    'pass' => getenv('DB_PASS'),          // Database password
    'db'   => getenv('DB_NAME'),  // Database name
    'host' => getenv('DB_HOST')  // Database host
];
$table = 'flagpost';
$primaryKey = 'idspPostings'; 
$columns = [
    ['db' => 'spPostingTitle', 'dt' => 0],
    ['db' => 'spPostingDate', 'dt' => 1],
    ['db' => 'spPostingDate', 'dt' => 2],
    ['db' => 'spPostingDate', 'dt' => 3],
    ['db' => 'spPostingDate', 'dt' => 4],
    ['db' => 'spPostingDate', 'dt' => 5]
];



// Define your custom WHERE clause
$where = "profileid = " . $_SESSION['pid'];
 
// Add JOIN clause
$join = "JOIN spjobboard ON spjobboard.idspPostings = flagpost.profileid";
 
// Fetch and output data using SSP library with JOIN and custom WHERE condition
$data = SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, $join, $where);
 

foreach ($data['data'] as &$row) {
    $row[2] = 0;
    $row[3] = 0;
    $row[4] = '<span class="status">Active</span>';
    $row[5] = '<img src="./images/dot-2.svg" alt="" class="dot three-dot-button" onclick="threeDot()">
                <div class="more-links" id="three-dot" style="display: none;">
                    <div class="link" data-bs-toggle="modal" data-bs-target="#anc-view">
                        <span class="img">
                            <img src="./images/view.svg" alt="">
                        </span>
                        <span>View Applicants</span>
                    </div>
                    <div class="link" data-bs-toggle="modal" data-bs-target="#anc-view">
                        <span class="img">
                            <img src="./images/pause.svg" alt="">
                        </span>
                        <span>Pause</span>
                    </div>
                    <div class="link" data-bs-toggle="modal" data-bs-target="#anc-view">
                        <span class="img">
                            <img src="./images/edit.svg" alt="">
                        </span>
                        <span>Edit</span>
                    </div>
                    <div class="link">
                        <span class="img" style="padding-left: 4px;">
                            <img src="./images/delete.svg" alt="">
                        </span>
                        <span>Delete</span>
                    </div>
                </div>';
}

echo json_encode(
    $data
);