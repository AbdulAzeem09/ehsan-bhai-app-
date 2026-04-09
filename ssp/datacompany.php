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
$table = 'company_news';
$primaryKey = 'spProfiles_idspProfiles'; 
$columns = [
    ['db' => 'cmpanynewsTitle', 'dt' => 0],
    ['db' => 'cmpanynewsDesc', 'dt' => 1],
    ['db' => 'cmpanynewsdate', 'dt' => 2],
   
];
$where = " spProfiles_idspProfiles = " . $_SESSION['pid']; // Add your custom WHERE clause
$data = SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null, $where);

foreach ($data['data'] as &$row) {

   $row[4] = '<td class="action">
                <img src="./images/dot-2.svg" alt="" class="dot" onclick="toggleMoreLinks(this)">
                <div class="more-links" id="three-dot" style="display: none;">
                    <div class="link" data-bs-toggle="modal" data-bs-target="#anc-view">
                        <span class="img">
                            <img src="./images/view.svg" alt="">
                        </span>
                        <span>View Applicants</span>
                    </div>
                    <div class="link edit-link" data-bs-toggle="modal" data-bs-target="#update-news" 
                         data-id="' . htmlspecialchars($row['idcmpanynews']) . '"
                         data-title="' . htmlspecialchars($row['cmpanynewsTitle']) . '"
                         data-content="' . htmlspecialchars($row['cmpanynewsDesc']) . '">
                        <span class="img">
                            <img src="./images/edit.svg" alt="">
                        </span>
                        <span>Edit News</span>
                    </div>
                    <div class="link">
                        <span class="img" style="padding-left: 4px;">
                            <img src="./images/delete.svg" alt="">
                        </span>
                        <span><a href="#" class="delete-link" data-draftid="' . htmlspecialchars($row['idcmpanynews']) . '">Delete Job</a></span>
                    </div>
                </div>
            </td>';

}

echo json_encode(
    $data
);