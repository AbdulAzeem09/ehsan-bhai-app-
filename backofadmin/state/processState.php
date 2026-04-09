
<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';
	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';

	switch ($action) {
		
		case 'delete' :
			deletee($dbConn);
			break;
		case 'add' :
			add($dbConn);
			break;
				
		default :
			redirect('index.php');
	}
	
	// ADD
	function add($dbConn){
		$txtCountry   = mysqli_real_escape_string($dbConn,$_POST['txtCountry']);
		$txtTitle   = mysqli_real_escape_string($dbConn,$_POST['txtTitle']);

		$sql2 = "SELECT state_id FROM tbl_state WHERE country_id = $txtCountry AND state_title = '$txtTitle' ";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=add');	
		}else{
			
			// Insert
			$sql   = "INSERT INTO tbl_state (country_id, state_title) VALUES ('$txtCountry','$txtTitle')";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// DELETE STATE
	function deletee($dbConn){
		if (isset($_GET['stateId']) && $_GET['stateId'] > 0){
			$stateId	=    $_GET['stateId'];
		}
		
		$sql = "UPDATE tbl_state SET status = '-7' WHERE state_id = $stateId";
		//$sql		=	"DELETE FROM tbl_state WHERE state_id = $stateId";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		
		redirect('index.php');			
	}
	
	

	

?>