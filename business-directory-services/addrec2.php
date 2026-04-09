<?php
session_start();
	include('../univ/baseurl.php');
	function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    
	
        $rcid=$_POST['rcid'];
        $rpid=$_POST['rpid'];

     $rstatus=$_POST['rstatus'];
 
   $f = new _favouriteBusiness; 
	if($rstatus == 2){
$data11_rec=array('idspProfiles_spProfileCompany'=> $rcid, 'spProfiles_idspProfiles'=> $rpid, 'isfavourite'=> $rstatus);	
	 $id = $f->create_heart_11_rec($data11_rec);
     //print_r($data11_rec);
    }
    else
    {
        $data11_rec=array('idspProfiles_spProfileCompany'=> $rcid, 'spProfiles_idspProfiles'=> $rpid, 'isfavourite'=> 2);	
     //print_r($data11);
     
     $f->delete_heart_11_rec($data11_rec); 
     
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