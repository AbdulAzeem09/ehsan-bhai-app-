<?php

/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/ 

date_default_timezone_set('Asia/Kolkata');
include '../univ/baseurl.php';
session_start();
 

	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	
	
	$obj=new _spprofiles;
	
	$obj2=new _news;

	$post_message=$_POST['post_message'];
	//echo $post_message;
	///die("8888888888888888888");
	
	$pid=$_SESSION['pid'];
	$uid=$_SESSION['uid'];
	  $randnum=$_POST['randnum'];
	 // die("QQQQQQQQQQQQQQQQQQQQQQQQQQQQ");
	
	; 
	
	  
	  
	 
	
	
	
	
	$data=array(
	
	'comment'=>$post_message,
	'pid'=>$pid,
	'userid'=>$uid,
	'comment_date'=>date('Y-m-d H:i:s')    
	);
	
	
	
	
	
	$lastid=$obj->createpostmessage($data);
	echo $lastid;
	

      $obj2=new _news;

	
	  $randnum=$_POST['randnum'];
	
	
	$result=$obj2->read_tempdata($randnum); 
	
	  
	  
	 
	   
	if($result!=false){
	
   while($row2=mysqli_fetch_assoc($result)){
	   
	   $filename=$row2['filename'];
	   $file_type=$row2['file_type'];
	   //$relation_id=$row2['relation_id'];
	   
	   
	   
	   $array=array(
	
	'attachmentfiles'=>$filename,
	'type'=>$file_type,
	'postid'=>$lastid,
	  
	);
	   
	   
	   $obj2->create_news_uploadfiles($array);
	   
	   $obj2->delete_news_tempfiles($randnum);
       
   }

 
   
		
	}
   
