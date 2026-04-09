<?php


	include('../../univ/baseurl.php');

	session_start();
	function sp_autoloader($class) {
		include '../../mlayer/' . $class . '.class.php';
	}


	spl_autoload_register("sp_autoloader");
	
    $fc = new _freelance_project_status;
   
	$fc->updatestatus($_GET['postid'],$_GET['status']);

$posting = new _freelancerposting;
	$posting->updatestartdate($_GET['postid']);
	$fps = $posting->read($_GET['postid']);
$projectdata = mysqli_fetch_array($fps);


$link = '<a href="'.$BaseUrl.'/freelancer/dashboard/project-bid.php?postid='.$_GET['postid'].'">Here</a>';
if($_GET['status'] == 1){
    
    $msg ="Your Project is Accepted by Freelancer Click ".$link." to check!";

}else{
	
	$msg ="Your Project is Rejected by Freelancer Click ".$link." to check!";

}


	           $pl = new _postenquiry;
                         $addmssage =  array('buyerProfileid' => $_SESSION['pid'],'sellerProfileid' => $projectdata['spProfiles_idspProfiles'],'module'=>'freelancer','message'=>$msg );
                         $pl->addenquiry($addmssage);

 

        $u = new _spprofiles;

                  $reciverdata = $u->read($projectdata['spProfiles_idspProfiles']); 

         if ($reciverdata != false) {

                    


                        $reciver = mysqli_fetch_array($reciverdata);

                        //print_r($reciver);


                     $reciveruserid = $reciver['spUser_idspUser'];   

                        /* print_r($bookedbuy);*/

                        $recivername = $reciver['spProfileName'];
                       
                        $reciveremail =  $reciver['spProfileEmail'];

         }  
        
$em = new _email;
         $em->sendprojectpostacept($recivername,$reciveremail,$msg);


 
    $re = new _redirect;
	$location = $BaseUrl."/freelancer/dashboard/active-project.php";
    $re->redirect($location);
	

?>


