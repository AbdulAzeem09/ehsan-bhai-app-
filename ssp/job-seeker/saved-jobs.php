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

$table = 'jobboard_save'; 
$primaryKey = 'save_id'; 
$columns = [
    ['db' => 'created_at',   'dt' => 0],
    ['db' => 'spPostingNotes', 'dt' => 1],
    ['db' => 'spPostingSkill', 'dt' => 2],
    ['db' => 'spPostingTitle', 'dt' => 3],
    ['db' => 'country_title', 'dt' => 4],
    ['db' => 'state_title', 'dt' => 5],
    ['db' => 'city_title', 'dt' => 6],
    ['db' => 'idspPostings', 'dt' => 7],
    ['db' => 'spPostingJobType', 'dt' => 8],
    ['db' => 'spPostingSlryRngFrm', 'dt' => 9],
    ['db' => 'spPostingSlryRngTo', 'dt' => 10],
    ['db' => 'job_currency', 'dt' => 11],
];

$where = " jobboard_save.spProfiles_idspProfiles = " . $_SESSION['pid']; 
$join = " 
        left join spjobboard ON jobboard_save.spPostings_idspPostings = spjobboard.idspPostings
        left join tbl_country on tbl_country.country_id = spjobboard.spPostingsCountry
        left join tbl_state on tbl_state.state_id = spjobboard.spPostingsState
        left join tbl_city on tbl_city.city_id = spjobboard.spPostingsCity
    ";

       
$order = " order by created_at desc ";       
$data = SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, $join, $where ,null ,$order );

foreach ($data['data'] as &$row) {
    $pdo = new PDO("mysql:host={$sql_details['host']};dbname={$sql_details['db']}", $sql_details['user'], $sql_details['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM job_apply WHERE pid = :pid AND job_id = :job_id");
    $stmt->execute(['pid' => $_SESSION['pid'], 'job_id' => $row[7]]);
    $count = $stmt->fetchColumn();
    $apply_link = '';
    if(!isset($_REQUEST['type'])){
        if ($count > 0) {
            $apply_link = ' <a href="#"><button class="main-btn">Already Apllied</button></a>';
        }else{
            $apply_link = ' <a href="../job-board/job-apply.php?postid='.$row[7].'"><button class="main-btn">APPLY NOW</button></a>';
        }
    }
    $skills_text = '';
    foreach(explode(',',$row[2]) as $skill) {
        $skills_text .= '<div class="skill" style="display: inline-block; padding: 5px 10px; background-color: #eef; border-radius: 5px; margin-right: 5px;">'.$skill.'</div>';

    }
    $row[0] = '<div class="job" style="margin-bottom: 20px;padding: 15px;border: 1px solid #ddd;border-radius: 8px;background-color: #fff;">
                    <div class="salary"> '.$row[8].' </div>
                    <div class="title" style="max-width: 100%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                        <a href="../job-board/job-detail.php?postid='.$row[7].'" class="head-link">'.$row[3].'</a>
                    </div>
                    <div class="skills" style="justify-content: start;"> '.$skills_text.' </div>
                    <div class="location">
                        <img src="./images/location.svg" alt="">
                        <span>'.$row[6].', '.$row[5].', '.$row[4].'</span>
                    </div>
                    <div class="salary" style="margin-top: 10px;">Salary  '.$row[11].' '.$row[9].' -  '.$row[11].' '.$row[10].'</div>
                    <div class="date-created"> Date Saved: '.$row[0].' </div>
                '.$apply_link.'
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
                            <img src="./images/delete.svg" alt="">
                        </span>
                        Remove
                    </div>
                </div-->
            </div>
        </div>
    </div>';
    unset($row[1]);
    unset($row[2]);
    unset($row[3]);
    unset($row[4]);
    unset($row[5]);
    unset($row[6]);
    unset($row[7]);
    unset($row[8]);
}

echo json_encode(
    $data
);