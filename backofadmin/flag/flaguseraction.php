<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';

	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';
	switch ($action) {
		
		case 'delete' :
			deleteUser($dbConn);
			break;
		case 'lock' :
			lockUser($dbConn);
			break;	
		case 'unlock' :
			unlockUser($dbConn);
			break;	
		default :
			// if action is not defined or unknown
			// move to main index page
			redirect('index.php');
	}
	
	function deleteUser($dbConn){
		if (isset($_GET['userId']) && $_GET['userId'] > 0){
			$userId	=    $_GET['userId'];
		}
		
		$sql		=	"DELETE FROM spuser WHERE idspUser = $userId";
		$result 	= 	dbQuery($dbConn, $sql);

		
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		redirect('index.php?view=flagtimelinepost');			
	}
	// user account locked
	function lockUser($dbConn){
		if (isset($_GET['userId']) && $_GET['userId'] > 0) {
			$userId = $_GET['userId'];
			$sql = "UPDATE spuser SET spUserLock = 1 WHERE idspUser = $userId";
			$result = dbQuery($dbConn, $sql);
            
            

            $sql2 = "UPDATE flagtimelinepost SET spUserLockstatus = 1 WHERE flagpostuserid = $userId";
			$result1 = dbQuery($dbConn, $sql2);

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Account Locked Successfully.";
			redirect('index.php?view=flagtimelinepost');	
		}
	}
	// unlock user account
	function unlockUser($dbConn){
		if (isset($_GET['userId']) && $_GET['userId'] > 0) {
			$userId = $_GET['userId'];
			$sql = "UPDATE spuser SET spUserLock = 0 WHERE idspUser = $userId";
			$result = dbQuery($dbConn, $sql);

			$sql2 = "UPDATE flagtimelinepost SET spUserLockstatus = 0 WHERE flagpostuserid = $userId";
			$result1 = dbQuery($dbConn, $sql2);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Account Un-Locked Successfully.";
			redirect('index.php?view=flagtimelinepost');	
		}
	}

	
	

?>