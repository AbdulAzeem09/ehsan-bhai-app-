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
    $spPostingCustomQuestion = $row['spPostingCustomQuestion'];
    if($spPostingCustomQuestion!=null){
        $spPostingCustomQuestion = json_decode($spPostingCustomQuestion,true);
        $custom_answr = explode(",",$row['custom_answers']);
    }
    if ($row) {
        ?>
           <table class='table table-bordered table-striped'>
            <tr>
                <td>Applicant Name</td>
                <td><?php echo htmlspecialchars($row['myprofile']); ?></td>
            </tr>
            <tr>
                <td>Resume</td>
                <td><a href="<?php echo htmlspecialchars($row['resume_url']); ?>" target="_blank">View Resume</a></td>
            </tr>
            <tr>
                <td>Desired Salary</td>
                <td><?php echo htmlspecialchars($row['desired_salary']); ?></td>
            </tr>
            <tr>
                <td>Cover Letter</td>
                
            <td>
                <?php
                require_once '../../dompdf/autoload.inc.php';

                if (isset($row['coverletter_title']) && isset($row['coverletter_dec'])) {
                    
                    echo '<a href="../ssp/job-employee/download-cover-letter.php?id='.$id.'" download>Download Cover Letter</a>';
                } else {
                    echo 'Cover letter not available';
                }
                ?>
            </td>
            </tr>
            <tr>
                <td>When can you start ?</td>
                <td><?php echo htmlspecialchars($row['start_date']); ?></td>
            </tr>
            <tr>
                <td>Custom Questions</td>
                <td>
                    <?php
                    if($spPostingCustomQuestion!=null){
                        foreach($spPostingCustomQuestion['custom_question_title'] as $key=>$question){
                            echo "<p><strong>".$question."</strong></p>";
                            echo "<p>".$custom_answr[$key]."</p>";
                        }
                    }
                    ?>
                </td>
           </table>
        <?php
    } else {
        echo "No applicant found with ID: " . htmlspecialchars($id);
    }
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}