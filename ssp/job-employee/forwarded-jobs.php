<?php
//echo json_encode($_POST);exit;
session_start();
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
    'user' => getenv('DB_USER'), // Database username
    'pass' => getenv('DB_PASS'), // Database password
    'db'   => getenv('DB_NAME'), // Database name
    'host' => getenv('DB_HOST')  // Database host
];
$conn = mysqli_connect($sql_details['host'], $sql_details['user'], $sql_details['pass'], $sql_details['db']);
$table = 'jb_forwardjob_details'; 
$primaryKey = 'frwId'; 
$columns = [
    ['db' => 'spPostingTitle', 'dt' => 0],
    ['db' => 'createdAt', 'dt' => 1],
    ['db' => 'spProfileName', 'dt' => 2],
    ['db' => 'frwEmail', 'dt' => 3],
    ['db' => 'spProfileName', 'dt' => 4],
    ['db' => 'idspPostings', 'dt' => 5]
];

$where = " frwReciverId = " . $_SESSION['pid'];
if(isset($_REQUEST['type']) && $_REQUEST['type'] == "sent"){
    $where = " frwSenderId = " . $_SESSION['pid'];
}

$join = " left join spjobboard on spjobboard.idspPostings = jb_forwardjob_details.frwJobId left join spprofiles on spprofiles.idspProfiles = jb_forwardjob_details.frwSenderId";
$data = SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, $join, $where);

foreach ($data['data'] as &$row) {
   $row[0] = '<a href="/job-board/job-detail.php?postid='.$row[5].'">'.$row[0].'</a>';
   unset($row[5]);
}

echo json_encode(
    $data
);