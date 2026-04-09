<?php
if(isset($_GET['postid'])){
	    require_once '../../backofadmin/library/config.php';
		require_once '../../backofadmin/library/functions.php';

		$postid= $_GET['postid'];
		
		if($_GET['work']=='deactive'){
			$sql =  "UPDATE sprealstate SET spPostingVisibility='0' WHERE idspPostings =" . $postid . "";
		}
		if($_GET['work']=='delete'){
			
			$sql1 =  "DELETE FROM sprealstate WHERE idspPostings =" . $postid . "";
			dbQuery($dbConn, $sql1);
			$sql =  "DELETE FROM sprealstatepics WHERE spPostings_idspPostings =" . $postid . "";
		}
	   // die('============');
				
				
		$result  = dbQuery($dbConn, $sql);
		
}
?>
<script>
	
	
	 window.location.href = '/real-estate/dashboard/rent-room.php';
	
	
	
	</script>