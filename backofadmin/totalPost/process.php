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
		if (isset($_GET['id']) && $_GET['id'] > 0){
			$id	=    $_GET['id'];
		}
		
		$sql = "UPDATE sppostings SET spPostingVisibility = '-7' WHERE idspPostings = $id ";
		//$sql		=	"DELETE FROM sppostings WHERE idspPostings = $id";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		redirect('index.php');			
	}

	
	

?>