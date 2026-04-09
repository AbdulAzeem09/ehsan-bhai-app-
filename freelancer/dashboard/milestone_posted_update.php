<?php


	include('../../univ/baseurl.php');
date_default_timezone_set("Asia/Kolkata");
	session_start();
	function sp_autoloader($class) {
		include '../../mlayer/' . $class . '.class.php';
	}


	spl_autoload_register("sp_autoloader");
	if($_GET['status']==1){
	$fc2 = new _milestone;
	
	$res22 = $fc2->read($_GET['postid']);
	
	if($res22){
	while($row222 = mysqli_fetch_assoc($res22)){
	$amt = $row222['amount'];
	$profil_id = $row222['freelancer_profile_id'];
	
	$fc3 = new _spprofiles;
	$res33 = $fc3->readprofileid22($profil_id);
	//echo $fc3->taname->sql;
	
	if($res33){
		$row223 = mysqli_fetch_assoc($res33);
		
//echo "<pre>";		print_r($row223);//die("-----");
			$idspUser = $row223['spUser_idspUser'];
			//echo $idspUser;
		
	
	$dat = array(
	'buyer_userid' => $_SESSION["uid"],
	'seller_userid' => $idspUser,
	'amount' => $amt,
	'orderid' => $_GET['postid'],
	'status' => '0',
	'balanceTransaction' => "Freelancer",
	'date_txn' => date("Y-m-d h:i:sa"),
	'transaction_date' => date("Y-m-d")
	);
	 $cr = new _spevent_transection;
	 $cr->create_freewallet($dat);
	}
	}
	}
	}
	//die("====");
	
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
	$location = $BaseUrl."/freelancer/dashboard/project-bid.php?postid=".$_GET['getid'];
    $re->redirect($location);
	

    // header('location:inbox.php');
    
?>


