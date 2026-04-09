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
$table = 'spjobboard';
$primaryKey = 'idspPostings'; 
$columns = [
    ['db' => 'spPostingTitle', 'dt' => 0],
    ['db' => 'spPostingSlryRngFrm' ,'dt' => 1],
    ['db' => 'spPostingSlryRngTo' ,'dt' => 2],
    ['db' => 'spPostingNotes' ,'dt' => 3],
    ['db' => 'spPostingLocation' ,'dt' => 4],
    ['db' => 'flag_date' ,'dt' => 5],
    ['db' => 'spPostingSkill' ,'dt' => 6]
];

$join = " INNER JOIN flagpost ON flagpost.spPosting_idspPosting = spjobboard.idspPostings "; 
$where = " spjobboard.spProfiles_idspProfiles = '".$_SESSION['pid']."'  "; // Add your custom WHERE clause
$data = SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, $join, $where,null," ORDER BY flag_date DESC ");

foreach ($data['data'] as &$row) {
    $skills = $row[6];
    $skills = explode(',',$skills);
    $skill_text = '';
    foreach($skills as $skill){
        $skill_text .= '<div class="skill">'.$skill.'</div>';
    }

    $row[0] = '<div class="job border-red">							   
            <div class="salary">Salary $'.$row[1].' - '.$row[2].' USD</div>
            <div class="title">'.$row[0].' </div>
            <div class="description">'.$row[3].' </div>
            <div class="skills red-skills ">'.$skill_text.' </div>
            <div class="location">
                <img src="./images/location.svg" alt="">
                <span> '.$row[4].' </span>
            </div>
            <div class="date-created">
                Date Flagged : '.$row[5].'
            </div>

            <!--div class="actions">
                <div class="icon-wrapper">
                    <div class="icon" onclick="threeDot()">
                        <img src="./images/thre-dot-2.svg" alt="">
                    </div>
                    <div class="more-options" id="three-dot">
                        <div class="li">
                            <span>
                                <img src="./images/view.svg" alt="">
                            </span>
                            View Job
                        </div>

                        <div class="li">
                            <span>
                                <img src="./images/edit.svg" alt="">
                            </span>
                            Edit Job
                        </div>

                    </div>
                </div>
            </div-->                
        </div>';
    unset($row[1]);
    unset($row[2]);
    unset($row[3]);
    unset($row[4]);
    unset($row[5]);
    unset($row[6]);
    
}

echo json_encode(
    $data
);