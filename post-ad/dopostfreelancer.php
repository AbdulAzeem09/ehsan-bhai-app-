<?php
function sp_autoloader($class)
{
  include '../mlayer/' . $class . '.class.php';
}

session_start();

 include '../common.php';
spl_autoload_register("sp_autoloader");

if(isset($_POST['companyname']) && $_POST["companyname"]!= ''){

  $profile = new _spprofiles;
  
  $spProfileType_idspProfileType = 1;
  $is_active = 1;
  $spprofile = array();
  $spprofile[] = isset($_SESSION['email']) ? htmlspecialchars(trim($_SESSION['email'])) : '';
  $spprofile[] = isset($_SESSION['uid']) ? htmlspecialchars(trim($_SESSION['uid'])) : '';
  $spprofile[] = isset($_SESSION['username']) ? htmlspecialchars(trim($_SESSION['username'])) : '';
  $spprofile[] = isset($_POST["spUserCountry"]) ? htmlspecialchars(trim($_POST["spUserCountry"])) : '';
  $spprofile[] = isset($_POST["spUserState"]) ? htmlspecialchars(trim($_POST["spUserState"])) : '';
  $spprofile[] = isset($_POST["spUserCity"]) ? htmlspecialchars(trim($_POST["spUserCity"])) : '';
  $spprofile[] = isset($spProfileType_idspProfileType) ? (int) trim($spProfileType_idspProfileType) : 0;
  $spprofile[] = isset($is_active) ? (int) trim($is_active) : 0;
  $spprofile[] = 1;

  insertQ('UPDATE spprofiles  SET spProfilesDefault = ? WHERE spUser_idspUser = ?', 'ii', [0, $spprofile[1]]);

  $pid = insertQ('INSERT INTO  spprofiles (spProfileEmail,spUser_idspUser,spProfileName,spProfilesCountry,spProfilesState,spProfilesCity,spProfileType_idspProfileType,is_active,spProfilesDefault) VALUES (?,?,?,?,?,?,?,?,?)', 'sisiiiiii', $spprofile);
  $_POST['spProfiles_idspProfiles'] = $pid;
  //$pid = $_SESSION['pid']; // Assuming this value is already defined elsewhere
  $usr_id = $_SESSION['useridd']; 
  $data_business = array();
  $data_profile = array();
  $status = 2;
  // Checking if $userId is set, and trimming and casting it to integer if it's set
  $data_business[] = isset($pid) ? (int) trim($pid) : 0;
  $data_business[] = isset($_POST["companyname"]) ? htmlspecialchars(trim($_POST["companyname"])) : '';
  $data_business[] = isset($_POST["companytagline"]) ? htmlspecialchars(trim($_POST["companytagline"])) : '';
  $data_business[] = isset($_POST["companyProductService"]) ? htmlspecialchars(trim($_POST["companyProductService"])) : '';
  $data_business[] = isset($_POST["businesscategory"]) ? htmlspecialchars(trim($_POST["businesscategory"])) : '';
  
  $spUserCountry = isset($_POST["spUserCountry"]) ? htmlspecialchars(trim($_POST["spUserCountry"])) : '';
  $spUserState = isset($_POST["spUserState"]) ? htmlspecialchars(trim($_POST["spUserState"])) : '';
  $spUserCity= isset($_POST["spUserCity"]) ? htmlspecialchars(trim($_POST["spUserCity"])) : '';

 // Assuming insertQ function is defined elsewhere
  $fgfg = insertQ('INSERT INTO spbusiness_profile (spprofiles_idspProfiles,companyname,companytagline,companyProductService,businesscategory) VALUES (?,?,?,?,?)', 'isssi', $data_business);
 
  $data_profile[] = isset($pid) ? (int) trim($pid) : 0;
  $data_profile[] = isset($userId) ? (int) trim($userId) : 0;
  $data_profile[] = isset($_POST["companyname"]) ? htmlspecialchars(trim($_POST["companyname"])) : '';
  $data_profile[] = isset($_POST["spUserCountry"]) ? htmlspecialchars(trim($_POST["spUserCountry"])) : '';
  $data_profile[] = isset($_POST["spUserState"]) ? htmlspecialchars(trim($_POST["spUserState"])) : '';
  $data_profile[] = isset($_POST["spUserCity"]) ? htmlspecialchars(trim($_POST["spUserCity"])) : '';
  $data_profile[] = isset($status) ? (int) trim($status) : 0;

  $fgfgs = insertQ('INSERT INTO  spbuiseness_files (sp_pid,sp_uid,Business_Name,Country,State,City,status) VALUES (?,?,?,?,?,?,?)', 'iisiiii', $data_profile);
 

}
unset($_POST['companyname']);
unset($_POST['companytagline']);
unset($_POST['companyProductService']);
unset($_POST['businesscategory']);
unset($_POST['spUserCountry']);
unset($_POST['spUserState']);
unset($_POST['spUserCity']);


$p = new _freelancerposting;


$visb = $_POST['spPostingVisibility'];
$_POST['spPostingVisibility'] = (int)str_replace(" ", "", $visb);
if (isset($_POST["idspPostings"]) && $_POST["idspPostings"] != '') {

  // if($_POST['spPostingPriceHourly']=="0"){ 
  // 	$_POST['spPostingPriceFixed']=1;
  // }
  // if($_POST['spPostingPriceHourly']=="1"){
  // 	$_POST['spPostingPriceFixed']=0;
  // }


  // if($_POST['spPostingPriceFixed']=="0"){ 
  // 	$_POST['spPostingPriceHourly']=1;
  // }
  // if($_POST['spPostingPriceFixed']=="1"){
  // 	$_POST['spPostingPriceHourly']=0;
  // }
$_SESSION['updatefreelancer']='yes';
  if(!empty($_FILES['mediaFiles']['name'][0])){
  
    if ($_FILES['mediaFiles']['type'][0] !== 'application/pdf') {
        echo "Uploaded file is not a PDF. Please upload a PDF file.";
        exit; 
    }
    $s3 = new s3Class(3);
    //print_r($_FILES);
    $allS3SpPosting = $s3->storeAllInS3('mediaFiles', ['jpeg', 'pdf', 'txt', 'png', 'jpg', 'doc', 'docx', 'xlsx', 'xls','vnd.ms-excel', 'csv', 'msword', 'vnd.openxmlformats-officedocument.wordprocessingml.document', 'vnd.ms-excel', 'plain', 'vnd.openxmlformats-officedocument.spreadsheetml.sheet']);
    foreach($allS3SpPosting as $post){
      insertQ('insert into spfreelancerfile (spPostingFile, spPostings_idspPostings, spFileName) values (?,?, ?)', 'sis', [$post['url'], $_POST["idspPostings"], $post['name']]);
    }
  }
  $postid = $p->update($_POST, "WHERE t.idspPostings =" . $_POST["idspPostings"]);
  echo trim($_POST["idspPostings"]);
} else {
  $_SESSION['postfreelancer']='yes';
  $postid = $p->create($_POST);
  if (!empty($_FILES['mediaFiles']['name'][0])) {
    foreach ($_FILES['mediaFiles']['type'] as $fileType) {
      if ($fileType !== 'application/pdf') {
        echo "Uploaded file is not a PDF. Please upload a PDF file.";
        exit; 
      }
    }
    $s3 = new s3Class(3);
    $allS3SpPosting = $s3->storeAllInS3('mediaFiles', ['jpeg', 'pdf', 'txt', 'png', 'jpg', 'doc', 'docx', 'xlsx', 'xls','vnd.ms-excel', 'csv', 'msword', 'vnd.openxmlformats-officedocument.wordprocessingml.document', 'vnd.ms-excel', 'plain', 'vnd.openxmlformats-officedocument.spreadsheetml.sheet']);
    foreach($allS3SpPosting as $post){
      insertQ('insert into spfreelancerfile (spPostingFile, spPostings_idspPostings, spFileName) values (?,?, ?)', 'sis', [$post['url'], $postid, $post['name']]);
    }
    /*   $fr= new _spuser;
      $readsp= $fr->readdataSp($_SESSION['pid']);
    if($readsp!=false){
    $rowsp=mysqli_fetch_assoc($readsp);
      $post_pay =$rowsp['post_pay'];
      $pidAdd =$rowsp['idspProfiles'];
      $post_pay_add = $post_pay - 1;
      
      $readAdd= $fr->readdataAdd($post_pay_add,$pidAdd);
    }*/
  }
  echo trim($postid);
}
	
	  //echo $p->ta->sql;
