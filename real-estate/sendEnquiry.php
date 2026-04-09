<?php

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _realenquiry;
	$p->create($_POST);
	//print_r($_POST);die("=====");
	
	//header('location:../photos/myenquiry.php');
   $fc = new _realstateposting;
	//$fps = $fc->read($_POST['idspPosting']);
	$fps = $fc->read($_POST['spPosting_idspPosting']);

	$projectdata = mysqli_fetch_array($fps);

	$msg ="Your property has a enquiry Please check!";

			$u = new _spprofiles;

         $reciverdata = $u->read(isset($projectdata['spProfiles_idspProfiles']) ? (int)$projectdata['spProfiles_idspProfiles'] :0); 

         if ($reciverdata != false) {
				$reciver = mysqli_fetch_array($reciverdata);
            $reciveruserid = $reciver['spUser_idspUser'];
            $recivername = $reciver['spProfileName'];
            $reciveremail =  $reciver['spProfileEmail'];
         }  
		// $reciveremail= "anoopmauryaam02@gmail.com";
        
        //echo 'here';
         $em = new _email;
         $em->sendrealstateenquery($recivername,$reciveremail,$msg);



	$re = new _redirect;
	
	if($_POST['sprealType'] == 0){
		$re->redirect("../real-estate/property-detail.php?postid=".$_POST['spPosting_idspPosting']."&msg=1");
	}else{
		$re->redirect("../real-estate/room-detail.php?postid=".$_POST['spPosting_idspPosting']."&msg=1");
	}
    
	
?>