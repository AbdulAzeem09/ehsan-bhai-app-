<?php
session_start();
	include('../univ/baseurl.php');
	function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    
	
	 $cid=$_POST['cid'];
    $pid=$_POST['pid'];

     $status=$_POST['status'];
 
   $f = new _favouriteBusiness; 
	if($status == 1){
$data11=array('idspProfiles_spProfileCompany'=> $cid, 'spProfiles_idspProfiles'=> $pid, 'isfavourite'=> $status);	
	 $id = $f->create_heart_11($data11);
    }
    else
    {
        $data11=array('idspProfiles_spProfileCompany'=> $cid, 'spProfiles_idspProfiles'=> $pid, 'isfavourite'=> 1);	
     //print_r($data11);
     
     $f->delete_heart_11($data11); 
     
    }
    
	 //header("location: user-newprofile.php?profile=$flid");
	
	

    // flag the post
  /*  $p = new _postingview;
    $p->updateFlag($_POST['spPosting_idspPosting']);

    $re = new _redirect;
    session_start();
    $_SESSION['count'] = 0;
    $_SESSION['data'] = "success";
    $_SESSION['errorMessage'] = "Flagged Successfully";
    $re->redirect($BaseUrl."/freelancer/project-detail.php?project=".$_POST['spPosting_idspPosting']);*/
     
	 
	 
?>