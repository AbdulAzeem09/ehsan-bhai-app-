<?php
error_reporting(0);
session_start();
	require_once '../../backofadmin/library/config.php';
		require_once '../../backofadmin/library/functions.php';
		
		
				       
	
		
		

		$portid=  $_GET['postid'];
		
		
		
			
			 $sql1 =  "DELETE FROM spcustomers_basket WHERE idspOrder =$portid";
			dbQuery($dbConn, $sql1);
			//echo $sql =  "DELETE FROM freelancer_newfield WHERE spPid =" . $postid . "";

	   
		
				
		//$result  = dbQuery($dbConn, $sql); 
		
		//if ($result) {
		//	header( " Location : https://dev.thesharepage.com/dashboard/portfolio/index.php " ); 
		//	die("-----gfdhfgh---------");
		//}
		
?>
<script>
 
		window.location.href = "/artandcraft/dashboard/my_order.php";
</script>

		
		