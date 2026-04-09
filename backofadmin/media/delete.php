<?php

require_once '../library/config.php';
	require_once '../library/functions.php';

	$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];

	if (!defined('WEB_ROOT')) {
		exit;
	}
	$id= $_GET['id'];
	$rowsPerPage = 25;
  	$sql		=	"DELETE FROM spmedia_add WHERE id = $id; ";    
	//echo $sql; die();
  	$result = dbQuery($dbConn, $sql);

  	// custom pagignation
	//$result     = dbQuery($dbConn, getPagingQuery($sql, $rowsPerPage));
	//$pagingLink = getPagingLink($dbConn, $sql, $rowsPerPage);
 	
?>
<script>
window.location.href = "index.php";
</script>