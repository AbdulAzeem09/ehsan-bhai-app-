<?php


	include('../univ/baseurl.php');

	session_start();
	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}


	spl_autoload_register("sp_autoloader");
		$em = new _email;
    $fc = new _freelance_chat_project;
   /* print_r($_POST);*/
	$id = $fc->create($_POST);
	/*print_r($id);*/

$pl = new _postenquiry;
                         $addmssage =  array('buyerProfileid' => $_POST['sender_idspProfiles'],'sellerProfileid' => $_POST['receiver_idspProfiles'],'module'=>'freelancer','message'=>'You got a direct hiring!' );
                         $pl->addenquiry($addmssage);

    if (isset($id)) {

    	  $u = new _spprofiles;

	                $reciverdata = $u->read($_POST['receiver_idspProfiles']);	

				 if ($reciverdata != false) {

                    


                        $reciver = mysqli_fetch_array($reciverdata);

                        //print_r($reciver);


                     $reciveruserid = $reciver['spUser_idspUser'];   

                        /* print_r($bookedbuy);*/

                        $recivername = $reciver['spProfileName'];
                       
                        $reciveremail =	 $reciver['spProfileEmail'];

				 }	

				 $em->sendhire($recivername,$reciveremail);

		
		}



//echo $fc->ta->sql;
    
    $re = new _redirect;
	$location = $BaseUrl."/freelancer/dashboard/freelancer_hire_project.php";
    $re->redirect($location);
	

    // header('location:inbox.php');
    
?>


