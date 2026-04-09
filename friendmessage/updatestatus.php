
<?php 
 	function sp_autoloader($class) {  
			include '../mlayer/' . $class . '.class.php';   
		}
		    session_start();

		spl_autoload_register("sp_autoloader");
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
 include('../univ/baseurl.php');
  
                $sp=new _spprofiles;
			//	die("++++++++++++++++++++444444+++");
				
				$status=$_GET['status'];
				echo $status;
				
                   if($status=='1')
				   {
					   
					  
					  $spup=$sp->upstatus($status,$_SESSION['pid']);    
 					 
				   }
				   if($status=='0')
				   {
					
					  $spup=$sp->upstatus($status,$_SESSION['pid']);
  					  
				   }
				   
				   
	
				   header("location:".$BaseUrl."/inbox.php");
				  
				      ?>   