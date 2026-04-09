<?php

	include('../univ/baseurl.php');
	require_once '../library/config.php';
	require_once '../library/functions.php';

	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';
	switch ($action) {
		
		case 'delete' :
			deleteUser($dbConn);
			break;
			case 2:

		case 'lock' :
			lockUser($dbConn);
			break;	
			
				case 'accepted' :
			accepted($dbConn);
			break;
			case 'rejected' :
			rejected($dbConn);
			break;
			
		case 'unlock' :
			unlockUser($dbConn);
			break;	
		default :
			// if action is not defined or unknown
			// move to main index page
			redirect($BaseUrl.'/backofadmin/registerdUser/index.php');
	}
	
	function deleteUser($dbConn){
		if (isset($_GET['userId']) && $_GET['userId'] > 0){
			$userId	=    $_GET['userId'];
		}
		
		$sql		=	"DELETE FROM spuser WHERE idspUser = $userId";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		redirect(@$BaseUrl.'/backofadmin/registerdUser/index.php');			
	}
	// user account locked
	function lockUser($dbConn){
		if (isset($_GET['userId']) && $_GET['userId'] > 0) {
			$userId = $_GET['userId'];
			$sql = "UPDATE spuser SET spUserLock = 1 WHERE idspUser = $userId";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Account Locked Successfully.";
			redirect(@$BaseUrl.'/backofadmin/registerdUser/index.php');
		}
	}
	// unlock user account
	function unlockUser($dbConn){
		if (isset($_GET['userId']) && $_GET['userId'] > 0) {
			$userId = $_GET['userId'];
			$sql = "UPDATE spuser SET spUserLock = 0 WHERE idspUser = $userId";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Account Un-Locked Successfully.";
			redirect(@$BaseUrl.'/backofadmin/registerdUser/index.php');	
		}
	}
		
			function accepted($dbConn){
		if (isset($_GET['id']) && $_GET['id'] > 0) {
			$userId = $_GET['id'];
			
			$sql = "UPDATE spbuiseness_files SET status = 2 WHERE id = $userId";
 
			$result = dbQuery($dbConn, $sql);
			//$_SESSION['count'] = 0;
			//$_SESSION['errorMessage'] = "Account Un-Locked Successfully.";
			 https://dev.thesharepage.com/backofadmin/registerdUser/index.php?view=baccount
 		header("Location: https://dev.thesharepage.com/backofadmin/registerdUser/index.php?view=baccount");
 
		}
			}
		
		function rejected($dbConn){
		if (isset( $_POST['ids']) && $_POST['ids'] > 0) {
			$userId = $_POST['ids'];
			$reject_reason=$_POST['reject_reason'];
			
			 $sql = "UPDATE spbuiseness_files SET status = 3 ,reject_reason='$reject_reason'  WHERE id = $userId";

			$result = dbQuery($dbConn, $sql);
			//$_SESSION['count'] = 0;
			//$_SESSION['errorMessage'] = "Account Un-Locked Successfully.";
		header("Location: https://dev.thesharepage.com/backofadmin/registerdUser/index.php?view=baccount");
 
		}
			}
		
		
	

	
	

?>