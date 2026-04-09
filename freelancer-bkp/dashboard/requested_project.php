<?php


	include('../../univ/baseurl.php');

	session_start();
	function sp_autoloader($class) {
		include '../../mlayer/' . $class . '.class.php';
	}


	spl_autoload_register("sp_autoloader");
	
    $fc = new _freelance_chat_project;
   /* print_r($_POST);*/
	$fc->updaterequeststatus($_GET['postid'],$_GET['status']);
//echo $fc->ta->sql;

	$fps = $fc->read($_GET['postid']);
$projectdata = mysqli_fetch_array($fps);


$link = '<a href="'.$BaseUrl.'/freelancer/dashboard/freelance_project_detail.php?postid='.$_GET['postid'].'">Here</a>';
if($_GET['status'] == 1){
    
    $msg ="Your Project is Accepted by Freelancer Click ".$link." to check!";

}else{
	
	$msg ="Your Project is Rejected by Freelancer Click ".$link." to check!";

}


	           $pl = new _postenquiry;
                         $addmssage =  array('buyerProfileid' => $projectdata['receiver_idspProfiles'],'sellerProfileid' => $projectdata['sender_idspProfiles'],'module'=>'freelancer','message'=>$msg );
                         $pl->addenquiry($addmssage);

 

        $u = new _spprofiles;

                  $reciverdata = $u->read($projectdata['sender_idspProfiles']); 

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
	$location = $BaseUrl."/freelancer/dashboard/freelancer_requested_project.php";
    $re->redirect($location);
	

    // header('location:inbox.php');
    
?>


