<?php
error_reporting(E_ALL);
use Dompdf\Dompdf;
session_start();
function loadEnv($file = '../.env') {
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
try {
    $pdo = new PDO("mysql:host={$sql_details['host']};dbname={$sql_details['db']}", $sql_details['user'], $sql_details['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_REQUEST['id'];
    $stmt = $pdo->prepare("SELECT * FROM job_apply 
                           left join spprofiles on spprofiles.idspProfiles = job_apply.pid 
                           left join spjobboard on spjobboard.idspPostings = job_apply.job_id
                           WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    require_once '../../dompdf/autoload.inc.php';
    $dompdf = new Dompdf();
    $html = "
        <style>
            h1,p {
                word-wrap: break-word;
            }
        </style>
        <h1>{$row['coverletter_title']}</h1>
        <p>{$row['coverletter_dec']}</p>
    ";
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("cover_letter.pdf", ["Attachment" => false]);
    
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}