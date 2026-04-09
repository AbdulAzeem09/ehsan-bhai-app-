
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
			redirect('index.php');
	}
	
	
	function deletee($dbConn){
		if (isset($_GET['sponsorId']) && $_GET['sponsorId'] > 0){
			$sponsorId	=    $_GET['sponsorId'];
		}
		
		$sql = "UPDATE sponsor SET status = '-7' WHERE idspSponsor = $sponsorId";
		//$sql		=	"DELETE FROM sponsor WHERE idspSponsor = $sponsorId";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		
		redirect('index.php');			
	}
	
	

	

?>