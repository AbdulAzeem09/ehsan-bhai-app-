<?php
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

loadEnv('.env');
require "./ssp/ssp.class.php";

$sql_details = [
    'user' => getenv('DB_USER'), // Database username
    'pass' => getenv('DB_PASS'), // Database password
    'db'   => getenv('DB_NAME'), // Database name
    'host' => getenv('DB_HOST')  // Database host
];

$table = $_POST['table']; 
$primaryKey = $_POST['primaryKey']; 
$dbRows = $_POST['dbRows'];
$columns = [];

foreach($dbRows as $key => $item){
    $columns[] = ['db' => $key, 'dt' => $item];
}

$where = $_POST['where'] ?? null;
$order = $_POST['orderBy'] ?? null;
$join = $_POST['join'] ?? null;

$data = SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, $join, $where, null, $order);

echo json_encode(
    $data
);

// pass ajax post data
// data: {
//     table: 'table_name',
//     primaryKey: 'key',
//     where : " where condition ", optional
//     join : " join query ", optional
//     orderBy : " ORDER BY column DESC ", optional
//     dbRows : {
//         'table.column' : '0'
//     }
// }