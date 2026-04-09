<?php

if (!defined('WEB_ROOT')) {
		exit;
	}
	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

	if(isset($_GET['catId']) && ($_GET['catId']) > 0){
		$catId  = $_GET['catId'];
	}else {
		
	}
	$catid=$_GET['catId'];
$sql = "delete FROM spcategories WHERE idspCategory ='$catid'";

	$result = dbQuery($dbConn, $sql);
	 
	
	redirect('/backofadmin/mainCategory/index.php');
 ?>