
<?php
	error_reporting(E_ALL);
   ini_set('display_errors', 1);

	include('../../univ/baseurl.php');
date_default_timezone_set("Asia/Kolkata");
	session_start();
	function sp_autoloader($class) {
		include '../../mlayer/' . $class . '.class.php';
	}


	spl_autoload_register("sp_autoloader");
	
	$fc2 = new _milestone;
	
	$id=$_GET['postid'];
	$pageid=$_GET['pageid'];
	$status=$_GET['status'];
	$sellerid =$_GET['sellerid'];
	$amt =$_GET['amt'];
	$sf  = new _milestone;
	//$res = $p->myExpireProduct(5, $_SESSION['pid']);
	$res = $sf->updatemilestonestatus_freelancer($id,$status);
	
if($status==1){
$data = array(
"buyer_userid" => $_SESSION['uid'],
"seller_userid" => $sellerid,
"amount" => $amt,
"orderid" => $id,
"status" => "0",
"balanceTransaction" => "Freelancer",
"date_txn" => date("Y-m-d h:i:sa"),
"transaction_date" => date("Y-m-d")
);
$cr = new _spevent_transection;
	 $cr->create_freewallet($data);

}
	header("Location:$BaseUrl/freelancer/dashboard/freelance_project_detail.php?postid=".$pageid);
	?>