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
    'pass' => getenv('DB_PASS'),      // Database password
    'db'   => getenv('DB_NAME'),      // Database name
    'host' => getenv('DB_HOST')        // Database host
];

$table = 'spdraftmessage';
$primaryKey = 'id'; 
$columns = [
    ['db' => 'draft_message', 'dt' => 0],
    // Add other columns as needed
];



 

// Add your custom WHERE clause
$where = "recieverid = " . $_SESSION['uid'];

$data = SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null, $where);

foreach ($data['data'] as &$row) {
  
       
    $row[0] = '<div class="list-wrapper">
	                  <div class="job">
                                <div class="salary">Salary $400 - 500 USD</div>
                                <div class="title">
                                    MEAN Full-Stack Developer
                                </div>
                                <div class="description">
                                   '. htmlspecialchars($row['draft_message']) .'
                                </div>
                                <div class="skills">
                                    <div class="skill">Web Development</div>
                                    <div class="skill">Html</div>
                                    <div class="skill">UI/UX</div>
                                    <div class="skill">Database</div>
                                </div>
                                <div class="location">
                                    <img src="./images/location.svg" alt="">
                                    <span>
                                        Webinar
                                    </span>
                                </div>
                                <div class="date-created">
                                    Date Created : 2024-01-12
                                </div>

                                <div class="actions">
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
                                            <div class="li">
                                                <span>
                                                    <img src="./images/delete.svg" alt="">
                                                </span>
                                                Delete Job
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
							</div>';
}

echo json_encode($data);
