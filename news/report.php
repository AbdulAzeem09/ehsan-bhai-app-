<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');


include '../univ/baseurl.php';
session_start();


	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	

	
		//session_start();

	 $obj=new _spprofiles;
	//print_r($_POST);
	//die("))))))))))))))))))))))");
	 $rid=$_POST['comment_id'];
	   $rmsg=$_POST['report_msg'];
	   $uid=$_SESSION['uid'];
	  $pid=$_SESSION['pid'];
	  //die("(((((((((((((((((((((((");
	  $data=array(
	  'comment_id'=>$rid,
	   'message'=>$rmsg,
	    'uid'=>$uid,
		 'pid'=>$pid
	  );
	 $obj->createreportdata($data);
	 
	 
	?>
	


   