<?php
	include('../../univ/baseurl.php');
	session_start();
if(!isset($_SESSION['pid'])){ 

    $_SESSION['afterlogin']="freelancer/";
    include_once ("../../authentication/islogin.php");
    
}else{
	function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$fps = new _freelance_project_status;
	$re = new _redirect;

	if(isset($_GET['postid']) && $_GET['postid'] > 0 && isset($_GET['pid']) && $_GET['pid'] >0){
		$spPosting_idspPostings = $_GET['postid'];
		$spProfiles_idspProfiles = $_GET['pid'];
		$price = $_GET['price'];
		//$fps_status = $_GET['accept'];
		//echo $_GET['statu'];
		if($_GET['status'] == 'accept'){
			$fps_status ="Acepted";
		}else{
			$fps_status = "Rejected";
		}
		$conn = _data::getConnection();

		$fps_start_date = date('Y m d');
		$chkAlready = $fps->checkStatusExist($spPosting_idspPostings, $spProfiles_idspProfiles);
		//echo $fps->ta->sql;
		if($chkAlready == false){
			$sql = "INSERT INTO freelance_project_status(spProfiles_idspProfiles, spPosting_idspPostings, fps_start_date, fps_status, fps_price) VALUES('$spProfiles_idspProfiles', '$spPosting_idspPostings', Now(), '$fps_status', $price)";	        
		}else{
			$sql = "UPDATE freelance_project_status SET spProfiles_idspProfiles = '$spProfiles_idspProfiles',spPosting_idspPostings = '$spPosting_idspPostings', fps_start_date = NOW(), fps_status = '$fps_status', status = '0' WHERE spPosting_idspPostings = '$spPosting_idspPostings'";
		}

         $pl = new _postenquiry;
                         $addmssage =  array('buyerProfileid' => $_SESSION['pid'],'sellerProfileid' => $spProfiles_idspProfiles,'message'=>'You got Awarded for project Click <a href="'.$BaseUrl.'/freelancer/dashboard/active-project.php">Here</a> to Check.' );

                        // print_r($addmssage);
                         $pl->addenquiry($addmssage);

   

    	  $u = new _spprofiles;

	                $reciverdata = $u->read($spProfiles_idspProfiles);	

				 if ($reciverdata != false) {

                    


                        $reciver = mysqli_fetch_array($reciverdata);

                        //print_r($reciver);


                     $reciveruserid = $reciver['spUser_idspUser'];   

                        /* print_r($bookedbuy);*/

                        $recivername = $reciver['spProfileName'];
                       
                        $reciveremail =	 $reciver['spProfileEmail'];

				 }	
				 $em = new _email;

				 $em->sendaward($recivername,$reciveremail);

		
	

		// insert or update
		$result = mysqli_query($conn, $sql);
        $url = $re->redirect($BaseUrl.'/freelancer/dashboard/project-bid.php?postid='.$spPosting_idspPostings);

	}else{
		$url = $re->redirect($BaseUrl.'/freelancer/dashboard/active-bid.php');
	}
	$activePage = 17;
	
?>

<?php
} ?>