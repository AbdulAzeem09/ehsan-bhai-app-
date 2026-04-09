<?php


	include('../../univ/baseurl.php');

	session_start();
	function sp_autoloader($class) {
		include '../../mlayer/' . $class . '.class.php';
	}


	spl_autoload_register("sp_autoloader");
	
    $fc = new _milestone;
    //print_r($_GET);
	$fc->updatemilestonestatus($_GET['postid'],$_GET['status']);
//echo $fc->ta->sql;



	$res = $fc->read($_GET['postid']);

	$row = mysqli_fetch_assoc($res);
//echo $fc->ta->sql;

	if($_GET['status'] == 1){
      
      $fa = new _freelance_account;

      $da =array(
      	           "spPosting_idspPostings"=>$row['freelancer_projectid'],
      	           "fa_current_amount"=>$row['amount'],
      	           "spProfile_idspProfile"=>$row['freelancer_profileid'],
      	           "spUser_idspuser"=>$_SESSION['uid'],
      	           "id_milestone"=>$_GET['postid'],
      	           "fa_date"=>date('Y-m-d h:i:s')      	           
      	            );

      $fa->transactionupdate($da);

	}
    
    $re = new _redirect;
	$location = $BaseUrl."/freelancer/dashboard/project-bid.php?postid=".$row['freelancer_projectid'];
    $re->redirect($location);
	

    // header('location:inbox.php');
    
?>


