<?php
session_start();
	require_once '../../backofadmin/library/config.php';
		require_once '../../backofadmin/library/functions.php';
		
		error_reporting(0);

				       
	  $id=$_GET['dataId'];
	  //echo $id;
	  //echo $_GET['work'];
	  //die('==');
 	$cat=$_GET['cat_id'];

		
		
	
		$portid=  isset($_GET['id']) ? (int) $_GET['id'] : 0;
		 //echo $portid;
	  //die('==');
		$category_Id = 0;
		if(isset($_POST['category_id'])) {
			$category_Id = $_POST['category_id'];
		}
		if($_GET['work']=='deactive'){
			$sql =  "UPDATE sprealstate SET spPostingVisibility='0' WHERE id =" . $portid . "";
		}
		if($_GET['work']=='delete'){
			
			 $sql1 =  "DELETE FROM freelancer_newfield WHERE id =$portid";
			dbQuery($dbConn, $sql1);
			//echo $sql =  "DELETE FROM freelancer_newfield WHERE spPid =" . $postid . "";
		}
	   
	   if($_GET['work']=='deactivate'){
	  
			echo $sql2 =  "UPDATE spbuisnesspostings SET status='2' WHERE idspbusiness =" . $id . "";
			dbQuery($dbConn, $sql2);
			?>
			<script>
 
		window.location.href = "https://dev.thesharepage.com/backofadmin/flag/index.php?catId=<?php echo  $cat; ?>&view=business ";
</script>
	<?php	}
		
				
		//$result  = dbQuery($dbConn, $sql); 
		
		//if ($result) {
		//	header( " Location : https://dev.thesharepage.com/dashboard/portfolio/index.php " ); 
		//	die("-----gfdhfgh---------");
		//}
		
?>
<script>
 
		window.location.href = "https://dev.thesharepage.com/dashboard/portfolio/index.php";
</script>

		
		
