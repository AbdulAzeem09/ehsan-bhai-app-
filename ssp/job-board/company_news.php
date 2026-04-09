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
    'user' => getenv('DB_USER'),      // Database username
    'pass' => getenv('DB_PASS'),          // Database password
    'db'   => getenv('DB_NAME'),  // Database name
    'host' => getenv('DB_HOST')  // Database host
];
$conn = mysqli_connect($sql_details['host'], $sql_details['user'], $sql_details['pass'], $sql_details['db']);
$table = 'company_news'; 
$primaryKey = 'idcmpanynews'; 
$columns = [
    ['db' => 'cmpanynewsTitle', 'dt' => 0],
    ['db' => 'cmpanynewsDesc', 'dt' => 1],
    ['db' => 'cmpanynewsdate', 'dt' => 2],
];
$where = " spProfiles_idspProfiles = " . $_REQUEST['id'];
$data = SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null, $where);

foreach ($data['data'] as &$row) {
   $row[0] = '<h6>'.$row[0].'</h6><p>'.$row[1].'</p><p><small style="float: right;display:inline-block">'.$row[2].'</small></p>';
}

echo json_encode(
    $data
);