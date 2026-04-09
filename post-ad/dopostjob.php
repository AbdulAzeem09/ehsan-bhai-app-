<?php


 include('../univ/baseurl.php');
 session_start();
/* function sp_autoloader($class){
  include '../mlayer/' . $class . '.class.php';
  }
  spl_autoload_register("sp_autoloader"); 
  $p = new _postings;
  if(isset($_POST["idspPostings"]))
  {
  $postid = $p->update( $_POST, "WHERE t.idspPostings =" . $_POST["idspPostings"]);
  echo trim($_POST["idspPostings"]);
  }

  else
  {
  if($_POST["spProfiles_idspProfiles"]!=""){
  if(isset($_POST["spPostingAlbum_idspPostingAlbum_"]))
  $postid = $p->post($_POST, $_FILES, $_POST["spPostingAlbum_idspPostingAlbum_"]);
  else
  $postid = $p->post($_POST, $_FILES);
  echo trim($postid);
  }
  } */

  function sp_autoloader($class) {
    include '../mlayer/' . $class . '.class.php';
  }
/*
print_r($_POST);*/
//print_r($_FILES);
  spl_autoload_register("sp_autoloader");
  //
  $p = new _jobpostings;  //model mplayer

  include '../common.php';



  //  $action = $_GET['action'];
  //$postid = $_GET['postid'];

if((isset($_GET['action']) && $_GET['action']== 'delete')){
  $postid = $_GET['postid'];
  $p->remove($postid);

 header('location:'. $BaseUrl.'/job-board/dashboard/expired-post.php');

}else{ 

  
$_POST["flag_status"] = 2 ;

  if (isset($_POST["idspPostings"]) && $_POST["idspPostings"]!= '') {
    $postid = $p->update($_POST, "WHERE t.idspPostings =" . $_POST["idspPostings"]);
    echo trim($_POST["idspPostings"]);
  }
   else {

    if(isset($_POST['companyname']) && $_POST["companyname"]!= ''){
    
      $profile = new _spprofiles;
      
      $spProfileType_idspProfileType = 1;
      $is_active = 1;
      $spprofile = array();
      $spprofile[] = isset($_SESSION['spUserEmail']) ? htmlspecialchars(trim($_SESSION['spUserEmail'])) : '';
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
     
      unset($_POST['companyname']);
      unset($_POST['companytagline']);
      unset($_POST['companyProductService']);
      unset($_POST['businesscategory']);
      unset($_POST['spUserCountry']);
      unset($_POST['spUserState']);
      unset($_POST['spUserCity']);
    
    }
    
    unset($_POST['companyname']);
    unset($_POST['companytagline']);
    unset($_POST['companyProductService']);
    unset($_POST['businesscategory']);
    unset($_POST['spUserCountry']);
    unset($_POST['spUserState']);
    unset($_POST['spUserCity']);

    

    $postid = $p->post($_POST, $_FILES);
    echo trim($postid);
   

    
  $fr= new _spuser;
  $readsp= $fr->readdataSp($_SESSION['pid']);

if($readsp!=false){
  //die('dfsfffssssssssssssssssssssssssssss');
$rowsp=mysqli_fetch_assoc($readsp);
	$post_pay =$rowsp['post_pay'];
	$pidAdd =$rowsp['idspProfiles'];
	$post_pay_add = $post_pay - 1;
	
	$readAdd= $fr->readdataAdd($post_pay_add,$pidAdd);
}
  }
}



    $_SESSION['count'] = 0;
    $_SESSION['data'] = "success";
    if($_POST['spPostingVisibility'] == 0){

      $_SESSION['errorMessage'] = "Delete Successfully";

    }else if($_POST['spPostingVisibility'] == -1){

     $_SESSION['errorMessage'] = "Job Added Successfully";

    }

  //echo $p->ta->sql;




?>
