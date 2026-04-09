<?php
	require_once '../../backofadmin/library/config.php';
		require_once '../../backofadmin/library/functions.php';
		
		$postid = isset($_GET['postid']) ? (int)$_GET['postid'] : 0;
		$category_Id = 0;
		if(isset($_POST['category_id'])) {
			$category_Id = $_POST['category_id'];
		}
		if($_GET['work']=='deactive'){
			$sql =  "UPDATE sprealstate SET spPostingVisibility='0' , spPostingPropStatus = 'deactive' WHERE idspPostings =" . $postid . "";
		}
		if($_GET['work']=='delete'){
			
			echo $sql1 =  "DELETE FROM sprealstate WHERE idspPostings =" . $postid . "";
			dbQuery($dbConn, $sql1);
			echo $sql =  "DELETE FROM sprealstatepics WHERE spPostings_idspPostings =" . $postid . "";
		}
	   // die('============');
				
			//echo $sql; die("-----------");	
		$result  = dbQuery($dbConn, $sql);
		
		if ($result) {
			header("Location: /real-estate/dashboard/active-property.php");
		}
?>
