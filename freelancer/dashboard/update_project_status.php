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
	//$posting->updatestartdate($_GET['postid']);
	$fps = $posting->read($_GET['postid']);
$projectdata = mysqli_fetch_array($fps);
 $project_name=$_GET['project'];
$login_user=$_SESSION['login_user'];
//print_r($_SESSION);die('+++');

$link = '<a href="'.$BaseUrl.'/freelancer/dashboard/project-bid.php?postid='.$_GET['postid'].'">Here</a>';
if($_GET['status'] == 1){
    
    $msg ="Your Project is Accepted by ".$login_user." Click ".$link." to check!";

}else{
	
	$msg ="Your Project is Rejected by  ".$login_user." Click ".$link." to check!";

}


	          // $pl = new _postenquiry;
                         $addmssage =  array('buyerProfileid' => $_SESSION['pid'],'sellerProfileid' => $projectdata['spProfiles_idspProfiles'],'module'=>'freelancer','message'=>$msg );
                //         $pl->addenquiry($addmssage);

 

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
        // echo  $reciver;
        // echo  $reciveruserid;
        // echo  $recivername;
        // echo  $reciveremail;
        // die("=======");

$em = new _email;
         $em->sendprojectpostacept($recivername,$reciveremail,$msg,$project_name);


 
    $re = new _redirect;
	$location = $BaseUrl."/freelancer/dashboard/active-project.php";
    $re->redirect($location);
	

?>


