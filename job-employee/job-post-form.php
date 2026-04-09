<?php
include('../univ/baseurl.php'); 
function sp_autoloader($class) {
    include '../mlayer/' . $class . '.class.php';
}
session_start();
spl_autoload_register("sp_autoloader");
$p = new _jobpostings();
$save_type = $_POST['save_type'];
$_POST = $_SESSION['jobData'];

// Prepare the data to be inserted
$jobinsert = [
    'spPostingVisibility' => ( ($save_type  == 'POST') ? '-1' : '0' ),
    'spuser_idspuser' => $_SESSION['uid'],
    'spProfiles_idspProfiles' => $_SESSION['pid'],
    'spPostingTitle' => $_POST['title'],
    'spPostingNotes' => $_POST['description'],
    'spPostingSkill' => $_POST['skill'],
    'spCategories_idspCategory' => $_POST['spCategoryId'],
    'spPostingLocation' => $_POST['location'], // Fixed the variable name
    'spPostingJobType' => $_POST['jobtype'], 
    'salary' => $_POST['salary'], //no columan 
    'job_currency' => $_POST['currency'], 
    'spPostingNoofposition' => $_POST['noposition'], 
    'spPostingsCountry' => $_POST['spUserCountry'],     
    'spPostingsState' => $_POST['spProfilesState'],
    'spPostingsCity' => $_POST['spProfilesCity'] ?? $_POST['spPostingsCity'],
	'spPostingSlryRngFrm' => $_POST['salary_from'],
    'spPostingSlryRngTo' => $_POST['salary_to'],    
    'spPostingExperience' => $_POST['experience'],
	'spPostingClosing' => $_POST['closingdate'],
	'eligible' => $_POST['eligible'],
	'relocate' => $_POST['relocate'],
	'desiresalary' => $_POST['desiresalary'],
    'startwork' => $_POST['startwork'],
    'spPostingDate' =>date('Y-m-d H:i:s'),
    'spPostingExpDt' => date('Y-m-d',strtotime('+12 Month')),
    'spPostingCustomQuestion' => (
        array_key_exists('custom_question_title', $_SESSION['jobData']) 
        ?
        json_encode(
            [
                'custom_question_title' => $_SESSION['jobData']['custom_question_title'] ,
                'custom_question_type'=> $_SESSION['jobData']['custom_question_type']
            ]
        )
        :
        null
    )
];

// Insert the job application into the database
if(isset($_POST['idspPostings'])&&$_POST['idspPostings']!=''){
    $idspPostings = $_POST['idspPostings'];
    unset($_POST['idspPostings']);
    $r = $p->update($jobinsert," where idspPostings = $idspPostings");
}else{
    $r = $p->insertposyingjob($jobinsert);
    try{
        $uid = $_SESSION['uid'];
        $pid = $_SESSION['pid'];
        $e = new _email;
        $p = new _jobalert;
        $title = $_POST['title'];
        $query = "left join spprofiles on spprofiles.idspProfiles = t.pid  WHERE t.pid='$pid' and t.spuserid='$uid' AND MATCH(t.keywords) AGAINST('$title' IN BOOLEAN MODE)";
        $response = $p->readJobAlert($query);
        if($response){
            while($row = mysqli_fetch_assoc($response)){
                $email = $row['email'];
                $cname = $row['spProfileName'];
                $message = "We are informed that the above job is created";
                $e->send_job_alert($email, $cname, $title, $message);
            }    
        }
    }catch(\Exception $e){}
}

unset($_SESSION['jobData']);
//var_dump($r);
// Check if the insertion was successful and provide feedback
if($jobinsert['spPostingVisibility']=='-1'){
    echo $jobinsert['spPostingTitle'].' Job posted  successfully!';
}else{
    echo $jobinsert['spPostingTitle'].' Job saved as Draft  successfully!';
}
?>