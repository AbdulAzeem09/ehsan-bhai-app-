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

	
  $Id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
	







 
// configuration


$row = $_POST['row'];
$rowperpage = 4;

// selecting posts
//$query = 'SELECT * FROM posts limit '.$row.','.$rowperpage;
$obj2=new _spprofilefeature;


$html = '';
$ress=$obj2->readfollowerloadmoredata($Id,$row,$rowperpage);  
					 //print_r($ress);
					//
					if($ress!=false){
						
					
						
						
						
					//echo $row2['spProfileName']; 
						//echo $row2['spProfilePic'];
						//die("++++++++++++++++++"); 
				
                  
					
	   
	  ?>
	  <div class="form-group"style="border-color: red;">
	  <?php 
	  while($row=mysqli_fetch_assoc($ress)){
						
                          $who=$row['who'];
						$res2=$obj2->readfollowersdata($who);
						
						$row2=mysqli_fetch_assoc($res2);
	   
	   ?>
	   <style>
						.followerstructure{
							margin-left: 4px;
                            margin-right: 4px;
							border:2px solid blue;
                            border-radius: 5px;
							padding: 2px;
						}
						</style>
	   
	 <?php  
   include('followerData.php');

	 }
					}	
	      
	 
	 echo $html;
	?>
	


   
