<?php



include '../univ/baseurl.php';
session_start();


	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	

	
  $sett=new _news;
  
	$uid=$_SESSION['uid'];
	
	$pid=$_SESSION['pid'];
	
	$radio=$_POST['radio'];//like
	$radio1=$_POST['radio1'];//comment
	$radio2=$_POST['radio2'];//share
	$radio3=$_POST['radio3'];
	
	$status=$_POST['status'];  
	  
	
	if($status==1){
		$data=array(
		'can_like'=>$radio
		);  
	 
	 
	 $sett->updateposettings($data,$uid,$pid); 
	 ////san_like
	}
	 
	 if($status==3){
	 $data1=array(
		'can_share'=>$radio2
		);  
	 
	 
	 $sett->updateposettings111($data1,$uid,$pid); 
	 //can_share
	 }
	 
	 if($status==2){ 
	 $data2=array(   
		'can_comment'=>$radio1
		);  
	 
	 
	 $sett->updateposettings222($data2,$uid,$pid);   
	 
	 //can_comment
	 }
	 
	 if($status==4){
	 $data3=array(
		'can_seeprofile'=>$radio3
		);  
	 
	 
	 $sett->updateposettings333($data3,$uid,$pid); 
	 
	 }
	 
	 
	 
	 
	 
	 
	?>
	


   