<?php


 /*error_reporting(E_ALL);
ini_set('display_errors', 1); */
	include('../univ/baseurl.php');
	session_start();
	if (!isset($_SESSION['pid'])) {
		$_SESSION['afterlogin'] = "job-board/";
		include_once ("../authentication/check.php");
		
		}else{
		
		function sp_autoloader($class) {
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		
		$post_id = isset($_POST['postid']) ? (int) $_POST['postid'] : 0;
		
		if(isset($_POST['submit'])){
		
		$postid=$post_id;
		$name=$_POST['name'];

		$comment=$_POST['comment'];

		$phone=$_POST['phone'];
		

		$email=$_POST['email'];
		
		$data=array(
		"uid"=>$_SESSION['uid'],
		"pid"=>$_SESSION['pid'],
		"postid"=>$post_id,
		"sellerprofile_id"=>$_POST['sellerprofile_id'],
		"name"=>$_POST['name'],
		"email"=>$_POST['email'],
		"phone"=>$_POST['phone'],
		"comment"=>$_POST['comment'],
		"address"=>$_POST['address'],
		"company_name"=>$_POST['cname'],
		"country"=>$_POST['country'],
		"state"=>$_POST['state'],
		"city"=>$_POST['city'],
		"zipcode"=>$_POST['zipcode']
		
		
		);
		$enq= new _businessrating;
		$enq1= $enq->create_business_enquiry($data); 
		$_SESSION['succes']=2;
		//print_r($_SESSION);
		//die('======================');
	
		$enq1= $enq->read_postid($postid);

		if($enq1){
		$row=mysqli_fetch_assoc($enq1);
		}

		$pid=$row['pid'];

		//echo $pid;die("=====1223");
	

		$pid1= $enq->rea_postid($pid);
		if($pid1){
		$row2=mysqli_fetch_assoc($pid1);
		}

		if($row2){

		$email_id=$row2['spProfileEmail'];

		}
		//echo $email_id;die("=====1223");
		$e = new _spprofiles;

		$result = $e->read_description(11);
		$rows = mysqli_fetch_assoc($result);
		$message = $rows['notification_description'];

		$em = new _email;
		$em->bussiness_send_mail($message,$name,$email_id,$comment,$email,$phone);

		header("Location: /business_for_sale/business_detail.php?postid=$postid");
		
		
		}
		}
	?>
