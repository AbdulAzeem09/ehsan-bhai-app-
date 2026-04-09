<?php
//require_once('../common.php');

include('../univ/baseurl.php');
session_start();

include "check_job_seeker.php";


function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$p = new _coverletter;

$array = [
    'spuid' => $_POST['uid'],
    'pid' => $_POST['pid'],
    'title' => $_POST['title'], // Corrected to match input name
    'coverletter' => $_POST['coverletter'], // Corrected to match input name
];

// Check if coverletter_id is set to determine if it's an update or insert
if (isset($_POST['coverletter_id']) && !empty($_POST['coverletter_id'])) { 
    $id = $_POST['coverletter_id'];
    $result = $p->updatecoverletter($array, $id);
    $_SESSION['coverletter_create_update'] = true;
} else {
    $result = $p->insertcoverletter($array);
    $_SESSION['coverletter_create_update'] = true;
}

$_SESSION['coverletter_update_msg'] = 'Cover letter saved successfully';

// Return response to AJAX
if ($result) {
    echo json_encode(['status' => 'success', 'message' => 'Cover letter saved successfully.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to save cover letter.']);
}

$array2 = [ 
    'spuid' => $_POST['uid'], 
    'pid' => $_POST['pid'],
    'title' => $_POST['pdfTitle'], // Cover letter title
    'coverletter' => $_POST['pdfContent'], // Cover letter content
];

// Insert into the job_coverletter table
// $r = $p->insertcoverletter($array2);
 
//if (isset($_POST['edit'])) {
  //  $r = $p->updateJobAlert($array, $_POST['pid']);
//} else {
   // $r = $p->insertJobAlert($array);
//}
