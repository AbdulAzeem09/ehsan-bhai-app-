<?php
error_reporting(0);
session_start();
	require_once '../../backofadmin/library/config.php';
		require_once '../../backofadmin/library/functions.php';
		
		
				       
	
		
		

		$portid=  $_GET['id'];
		$category_Id = 0;
		if(isset($_POST['category_id'])) {
			$category_Id = $_POST['category_id'];
		}
		if($_GET['work']=='deactive'){
			$sql =  "UPDATE spclassified SET spPostingVisibility='0' WHERE idspPostings =" . $portid . "";
				dbQuery($dbConn, $sql);
		}
		if($_GET['work']=='delete'){
			
			 $sql1 =  "DELETE FROM spclassified WHERE idspPostings =" . $portid . "";
			dbQuery($dbConn, $sql1);
			//echo $sql =  "DELETE FROM freelancer_newfield WHERE spPid =" . $postid . "";
		}
	   
		if($_GET['work']=='delete_to'){
			
			$sql1 =  "DELETE FROM spclassified WHERE idspPostings =" . $portid . "";
		   dbQuery($dbConn, $sql1);
		   header("Location: deactivated.php");
	   }
		
				
		
		
?>
<script>
 
		
		window.location.href = "active.php";
</script>

		
		