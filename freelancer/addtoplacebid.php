<?php
 // error_reporting(E_ALL);
 // ini_set('display_errors', 1);
function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
session_start();
 
$b = new _freelance_placebid;
 $id = $b->create($_POST);
 
 $idsppostings = $_POST['spPostings_idspPostings'];
$result = $b->read_project($idsppostings);

$rows = mysqli_fetch_assoc($result); 


$spprofile_id = $rows['spProfiles_idspProfiles'];
$spPostingTitle =  $rows['spPostingTitle'];

$result1 = $b->read_spprofile($spprofile_id);

$rows1 = mysqli_fetch_assoc($result1); 
$spprofileName = $rows1['spProfileName'];
$spProfileEmail = $rows1['spProfileEmail'];
// https://dev.thesharepage.com/freelancer/dashboard/project-bid.php?postid=16
$bidlink = $BaseUrl.'/freelancer/dashboard/project-bid.php?postid='.$idsppostings;
  $pid = $_SESSION['pid'];

  $result12 = $b->read_spprofile($pid);
  $rows12 = mysqli_fetch_assoc($result12); 
$u= new _spprofiles;

  $freelancer_name = $rows12['spProfileName'];
  $result13 = $u->read_description(9);
  $rows13 = mysqli_fetch_assoc($result13);
  $message = $rows13['notification_description'];
  $subject = $rows13['subject'];

 //https://dev.thesharepage.com/freelancer/user-newprofile.php?profile=3611
$Nlink = $BaseUrl.'/freelancer/user-newprofile.php?profile='.$pid;
$em = new _email;

$em->sendemailplacebid($subject,$message,$spProfileEmail,$spprofileName,$spPostingTitle,$freelancer_name,$bidlink,$Nlink);

$re = new _redirect;
session_start();
$_SESSION['count'] = 0;
$_SESSION['data'] = "success";
$_SESSION['errorMessage'] = "Bid added successfully!";
$re->redirect($BaseUrl."/freelancer/project-detail.php?project=".$_POST['spPostings_idspPostings']);


?>
