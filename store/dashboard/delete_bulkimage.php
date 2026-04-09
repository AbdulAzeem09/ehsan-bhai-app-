<?php
error_reporting(0);
include('../../univ/baseurl.php');
session_start();
	require_once '../../backofadmin/library/config.php';
		require_once '../../backofadmin/library/functions.php';
		
		
				       
	
		
		

		$bulkid = isset($_GET['id']) ? (int)$_GET['id'] : 0;
		$category_Id = 0;
		if(isset($_POST['category_id'])) {
			$category_Id = $_POST['category_id'];
		}
		if($_GET['work']=='deactive'){
			$sql =  "UPDATE sprealstate SET spPostingVisibility='0' WHERE id =" . $portid . "";
		}
		if($_GET['work']=='delete'){
			
			 $sql1 =  "DELETE FROM store_bulk_image WHERE id =" . $bulkid . "";
			dbQuery($dbConn, $sql1);
			//echo $sql =  "DELETE FROM freelancer_newfield WHERE spPid =" . $postid . "";
		}
	   
		
				
		//$result  = dbQuery($dbConn, $sql); 
		
		//if ($result) {
		//	header( " Location : https://dev.thesharepage.com/dashboard/portfolio/index.php " ); 
		//	die("-----gfdhfgh---------");
		//} 
		
?>
<script>
window.location.href = "<?php echo $BaseUrl ?>/store/dashboard/image_file.php";

</script>

		
		