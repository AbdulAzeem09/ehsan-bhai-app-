<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';

	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';
	switch ($action) {
		
		case 'delete' :
			deletee($dbConn);
			break;
			
		default :
			// if action is not defined or unknown
			// move to main index page
			redirect('index.php');
	}
	
	function deletee($dbConn){
		if (isset($_GET['pid']) && $_GET['pid'] > 0){
			$pid	=    $_GET['pid'];
		}
		
		$sql		=	"DELETE FROM spprofiles WHERE idspProfiles = $pid";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		redirect('index.php');			
	}

	
	

?>