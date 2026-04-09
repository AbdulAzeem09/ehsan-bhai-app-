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

	

	







 
// configuration


				$row = $_POST['row'];
				$rowperpage = 3;   
				 
										
						$sn= new _news;
                      $sds =$sn->readannounceloadmore($row,$rowperpage);
					  if($sds!=false){
					 while($rows=mysqli_fetch_assoc($sds))
					 {
						?>
						
						<div class="post1" id="post1"> 
						<div class="row listyle"> 
						<div class="col-md-9">
						<h3><?php echo $rows['title']; ?></h3>  
						<p><?php echo $rows['message']; ?></p> 
					</div>
					<div class="col-md-3" style="margin-top:30px">
					 <span><?php echo $rows['create_ondate']; ?></span> 
					</div>
					</div>
					</div>
					
              <?php						
					  }}
						?>   
	 
	 

	


   