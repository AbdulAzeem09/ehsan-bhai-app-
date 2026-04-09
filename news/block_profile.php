<?php



error_reporting(E_ALL);
ini_set('display_errors', 'On');

include '../univ/baseurl.php';
session_start();


	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$obj=new _news;  
	
                                
		  $whom2=$_POST['id'];
			   $who2=$_SESSION['pid'];
			
		 $obj->removefollowunfollow($who2,$whom2); 
			
			$obj->removefollowunfollow($whom2,$who2); 
			
		 $blockres=$obj->read_profile_block($_SESSION['pid'],$whom2);
		 
		  
		   if($blockres == false){ 
			
			
			
		 $whom2=$_POST['id'];
			   $who2=$_SESSION['pid'];
		 
		 
		 
		 
		 $blockdata=array(
		 
		 'whom'=>$whom2,  
		 'who'=>$who2
		 );
		 $obj->profile_block($blockdata);
		   
		 } else{
			$blockrow=mysqli_fetch_assoc($blockres);
		  $obj->profile_Unblock($blockrow['who'],$blockrow['whom']);
		   }
	header("location:https://dev.thesharepage.com/news/profile.php?id=$whom2");
	 
	?>
	


   