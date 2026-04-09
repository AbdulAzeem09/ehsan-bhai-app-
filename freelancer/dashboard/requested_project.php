<?php

	include('../../univ/baseurl.php');

	session_start();
	function sp_autoloader($class) {
		include '../../mlayer/' . $class . '.class.php';
	}


	spl_autoload_register("sp_autoloader");
	$postid = isset($_GET["postid"]) ? (int) $_GET["postid"] : 0;
  $status = isset($_GET["status"]) ? (int) $_GET["status"] : 0;
    $fc = new _freelance_chat_project;
   /* print_r($_POST);*/
	$fc->updaterequeststatus($postid,$status);
//echo $fc->ta->sql;

	$fps = $fc->read($postid);
$projectdata = mysqli_fetch_array($fps);


$link = '<a href="'.$BaseUrl.'/freelancer/dashboard/freelance_project_detail.php?postid='.$postid.'">Here</a>';
if($status == 1){
    
    $msg ="Your Project is Accepted by Freelancer Click ".$link." to check!";

}else{
	
	$msg ="Your Project is Rejected by Freelancer Click ".$link." to check!";

}


	           $pl = new _postenquiry;
                         $addmssage =  array('buyerProfileid' => $projectdata['receiver_idspProfiles'],'sellerProfileid' => $projectdata['sender_idspProfiles'],'module'=>'freelancer','message'=>$msg );
                         $pl->addenquiry($addmssage);

 

        $u = new _spprofiles;

                  $reciverdata = $u->read($projectdata['sender_idspProfiles']); 
                  
                  $sf = new _freelancerposting;
                  $project_name='';
                  $result = $sf->singletimelines1($postid);
                  if ($result != false) {    
                    $row2 = mysqli_fetch_assoc($result);
                      $project_name = $row2['spPostingTitle'];
                    }
         
            
 
         if ($reciverdata != false) {

           $reciver = mysqli_fetch_array($reciverdata);

           //print_r($reciver);


           $reciveruserid = $reciver['spUser_idspUser'];   

           /* print_r($bookedbuy);*/

            $recivername = $reciver['spProfileName'];

            $reciveremail =  $reciver['spProfileEmail'];

        }
        $re = new _redirect;
	      $location = $BaseUrl."/freelancer/dashboard/freelancer_requested_project.php"; 
        if($project_name != ''){
          $em = new _email;
          $em->sendprojectpostacept($recivername,$reciveremail,$msg,$project_name);
          $re->redirect($location);

       }
       else{
         $re->redirect($location);
       }
        // header('location:inbox.php');

?>


