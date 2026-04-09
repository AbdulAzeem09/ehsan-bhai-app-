<?php

include('../univ/baseurl.php');
session_start();
function sp_autoloader($class) {
    include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
$p = new _coverletter(); 

$jobinsert = [
    'job_id' => $_POST['job_id'],
    'uid' => $_POST['uid'],
    'pid' => $_POST['pid'],
    'spUserEmail' => $_POST['spUserEmail'],
    'spPostCountry' => $_POST['spPostCountry'],
    'spPostState' => $_POST['spPostState'],
    'myprofile' => $_POST['myprofile'], 
    'resume_url' => $_SESSION['tmp_resume'],
    'documentUrl' => $_POST['documentUrl'],
    'coverletter_title' => $_POST['cover_title'], 
    'coverletter_dec' => $_POST['cover_content'], 
    'start_date' => $_POST['start_date'], 
    'desired_salary' => $_POST['desired_salary'], 
    'eligibility' => $_POST['eligibility'],     
    'relocation' => $_POST['relocation'],
    'fileName' => $_SESSION['documentUrl'],
	'jobtitle' => $_POST['job_title'],
    'job_dec' => $_SESSION['job_overview'],
    'status' => ( isset($_POST['clicked_btn']) && $_POST['clicked_btn']=='save_to_draft' ? 'draft' : 'active' ),
    'custom_answers' => ( isset($_POST['custom_answers']) && count($_POST['custom_answers']) ? implode(',',$_POST['custom_answers']) : null  )
];

// print_r($jobinsert);exit; 
// Insert the job application into the database
if( isset($_POST['pre_post_id']) ){
    $r = $p->updateJobApply($jobinsert,$_POST['pre_post_id']);
}else{
    $check = $p->check_duplicate($_SESSION['pid'],$_POST['job_id']);
    if( $check ){
        echo json_encode(['status'=>false,'msg'=>'You have already applied for this job.']);
        exit;
    }else{
        $r = $p->insertJob($jobinsert);
    }
}
// Check if the insertion was successful and provide feedback
echo json_encode(['status'=>true,'msg'=>'Application submitted successfully!']);
exit;
?>