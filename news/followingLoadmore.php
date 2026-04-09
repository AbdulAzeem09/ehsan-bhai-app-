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

	
  $p_Id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
	







 
// configuration


$row = $_POST['row']; 
$rowperpage = 4;

// selecting posts
//$query = 'SELECT * FROM posts limit '.$row.','.$rowperpage;
$obj2=new _spprofilefeature;



$html = '';
$ress=$obj2->readfollowingloadmoredata($p_Id,$row,$rowperpage);  
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
		
		$whom=$row['whom'];
		
			if($_SESSION['pid']==$whom){
			
			continue;
		}
		
						
						
						$res2=$obj2->readfollowingdata($whom);
						if($res2!=false){
						$row2=mysqli_fetch_assoc($res2);
						}
						
						  $p = new _spprofiles;
						$result = $p->read($p_Id);
						if($result!=false){
						$row6=mysqli_fetch_assoc($result);
						}
						 $idspProfileType=$row6['spProfileType_idspProfileType']; 
													                 
						$new=new _spprofilefeature ;
						
					  $resss=$new->readprotyp($idspProfileType);
					  if( $resss!=false){
					  $rowww=mysqli_fetch_assoc($resss);
					   
					  }
						
						
						?>
						
						<style>
						.followingstructure{
							margin-left: 4px;
                            margin-right: 4px;
							border:2px solid blue;
                            border-radius: 5px;
							padding: 2px;
						}
						</style>
						
						
	  
	  
	  
    
      
    
    
	  
	   <?php 
	   
	   include 'followingData.php'; 
	   
	   		}
					}
	
	 
	 
	?>
	


   
