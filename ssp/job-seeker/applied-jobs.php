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
    ['db' => 'jobtitle',   'dt' => 0],
    ['db' => 'subCategoryTitle', 'dt' => 1],
    ['db' => 'applied_on', 'dt' => 2],
    ['db' => 'status', 'dt' => 3],
    ['db' => 'id', 'dt' => 4],
    ['db' => 'job_id', 'dt' => 5]
];
$where = " pid = " . $_SESSION['pid'] . ( isset($_GET['type']) && $_GET['type'] == 'draft' ? " AND status = 'draft'" : " and status = 'active'" ); 
$join = " left join spjobboard ON job_apply.job_id = spjobboard.idspPostings  LEFT JOIN subcategory ON spjobboard.spCategories_idspCategory = subcategory.idsubcategory";
$data = SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, $join, $where);

foreach ($data['data'] as &$row) {
    $row[3] = ( isset($_GET['type']) && $_GET['type'] == 'draft' ? 'Draft' : 'Active' );
    $row[0] = '<a href="/job-board/job-detail.php?postid='.$row[4].'">'.$row[0].'</a>';
    if( isset($_GET['type']) && $_GET['type'] == 'draft' ) {
        $row[4] = '<a href="../job-board/job-apply.php?pre_post_id='.$row[4].'&postid='.$row[5].'" class="theme-btn" onclick="deleteJob('.$row[4].')">Edit & Apply</a>';
    }
    
}

echo json_encode(
    $data
);