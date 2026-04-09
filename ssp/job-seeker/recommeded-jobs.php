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

$dsn = "mysql:host=" . $sql_details['host'] . ";dbname=" . $sql_details['db'];
try {
    $pdo = new PDO($dsn, $sql_details['user'], $sql_details['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // $stmt = $pdo->prepare("
    //     SELECT GROUP_CONCAT(spjobboard.spPostingSkill SEPARATOR ', ') as spPostingSkill
    //     FROM job_apply
    //     LEFT JOIN spjobboard ON job_apply.job_id = spjobboard.idspPostings 
    //     WHERE job_apply.status = 'active'
    //     AND job_apply.pid = :pid
    // ");
    // $stmt->execute(['pid' => $_SESSION['pid']]);

    $stmt = $pdo->prepare("
        SELECT GROUP_CONCAT(spemployment_profile.skill SEPARATOR ', ') as spPostingSkill
        FROM spemployment_profile
        WHERE spemployment_profile.spprofiles_idspProfiles = :pid
    ");
    $stmt->execute(['pid' => $_SESSION['pid']]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $skills = $result['spPostingSkill'];
    } else {
        $skills = '';
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

// echo $_SESSION['pid'];
// echo "<pre>"; print_r($skills);die();

$table = 'spjobboard'; 
$primaryKey = 'idspPostings'; 
$columns = [
    ['db' => 'idspPostings',   'dt' => 0],
    ['db' => 'spPostingTitle', 'dt' => 1],
    ['db' => 'spPostingNotes', 'dt' => 2],
    ['db' => 'spPostingSkill', 'dt' => 3],
    ['db' => 'spPostingSlryRngFrm', 'dt' => 4],
    ['db' => 'spPostingSlryRngTo', 'dt' => 5],
    ['db' => 'spPostingJobType', 'dt' => 6],
    ['db' => 'spPostingDate', 'dt' => 7],
    ['db' => 'job_currency', 'dt' => 8],
    ['db' => 'spPostingsCountry', 'dt' => 9],
    ['db' => 'spPostingsState', 'dt' => 10],
    ['db' => 'spPostingsCity', 'dt' => 11],
];

$where = '';
if(!empty($skills)) {
    $skillsArray = explode(',', $skills);
    $where = " (";
    foreach ($skillsArray as $index => $skill) {
        if ($index > 0) {
            $where .= " OR ";
        }
        $cleanSkill = preg_replace('/[^a-zA-Z0-9\s]/', '', $skill);
        $where .= "FIND_IN_SET('$cleanSkill', spPostingSkill)";
    }
    $where .= ")";
}

$country = $_SESSION['Countryfilter'];
$state = $_SESSION['Statefilter'];
$where .= " AND spPostingsCountry = '$country' AND spPostingsState = '$state'";
// echo "<pre>"; print_r($skills);exit;
$join = null;
$data = SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, $join, $where);

foreach ($data['data'] as &$row) {
    /****code to add start***/
    $row[2] = strip_tags($row[2]);
    $row[2] = preg_replace('/[^A-Za-z0-9 ]/', '', $row[2]);
	/****code to add end***/
    $pdo = new PDO("mysql:host={$sql_details['host']};dbname={$sql_details['db']}", $sql_details['user'], $sql_details['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM job_apply WHERE pid = :pid AND job_id = :job_id");
    $stmt->execute(['pid' => $_SESSION['pid'], 'job_id' => $row[0]]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        $apply_link = ' <a href="#"><button class="main-btn">Already Apllied</button></a>';
    }else{
        $apply_link = ' <a href="../job-board/job-apply.php?postid='.$row[0].'"><button class="main-btn">APPLY NOW</button></a>';
    }
    
    $skills_text = '';
    foreach(explode(',',$row[3]) as $skill) {
        $skills_text .= '<div class="skill" style="display: inline-block; padding: 5px 10px; background-color: #eef; border-radius: 5px; margin-right: 5px;">'.$skill.'</div>';
    }

    $locationStmt = $pdo->prepare("
        SELECT tbl_country.country_title,tbl_state.state_title, tbl_city.city_title  FROM spjobboard
        left join tbl_country on tbl_country.country_id = spjobboard.spPostingsCountry
        left join tbl_state on tbl_state.state_id = spjobboard.spPostingsState
        left join tbl_city on tbl_city.city_id = spjobboard.spPostingsCity
        WHERE idspPostings = :job_id
    ");

    $locationStmt->execute(['job_id' => $row[0]]);
    $locationData = $locationStmt->fetch(PDO::FETCH_ASSOC);

    $row[0] = '<div class="job" style="margin-bottom: 20px; padding: 15px; border: 1px solid #ddd; border-radius: 8px; background-color: #fff;">
        <div class="salary"> '.$row[6].' </div>
        <div class="title" style="max-width: 100%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
            <a href="../job-board/job-detail.php?postid='.$row[0].'" class="head-link">'.$row[1].'</a>
        </div>
        <div class="skills" style="max-width: 100%; overflow: hidden;justify-content:start;">
            '.$skills_text.'
        </div>
        <div class="location" style="margin-top: 10px;">
            <img src="./images/location.svg" alt="" style="vertical-align: middle;">
            <span>'.$locationData['city_title'] .', '.$locationData['state_title'].', '.$locationData['country_title'].'</span>
        </div>
        <div class="salary" style="margin-top: 10px;"> Salary  '.$row[8].' '.$row[4].' -  '.$row[8].' '.$row[5].' </div>
        <div class="date-created" style="margin-top: 10px;">Date Posted: '.$row[7].'</div>
        '.$apply_link.'
    </div>';
}

echo json_encode(
    $data
);