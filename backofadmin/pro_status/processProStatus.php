
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
		case 'modify' :
			modify($dbConn);
			break;		
		default :
			redirect('index.php');
	}
	//Modify CATEGORY
	function modify($dbConn) {
		$hidId	= mysqli_real_escape_string($dbConn, $_POST['hidId']);
		$txtTitle   = mysqli_real_escape_string($dbConn,$_POST['txtTitle']);

		// update content
		$sql2 = "SELECT idspProStatus FROM property_status WHERE spProStatusTitle = '$txtTitle' ";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added!";
			$_SESSION['data'] = "success";
			redirect('index.php?view=modify&proStatus='.$hidId);	
		}else{
			$sql = "UPDATE property_status SET spProStatusTitle ='$txtTitle' WHERE idspProStatus = $hidId";
			$result = dbQuery($dbConn, $sql);

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully!";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// ADD
	function add($dbConn){
		$txtTitle   = mysqli_real_escape_string($dbConn,$_POST['txtTitle']);
		
		$sql2 = "SELECT idspProStatus FROM property_status WHERE spProStatusTitle = '$txtTitle' ";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=add');	
		}else{
			
			// Insert
			$sql   = "INSERT INTO property_status (spProStatusTitle) VALUES ('$txtTitle')";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// DELETE THE MAIN CATEGORY
	function deletee($dbConn){
		if (isset($_GET['proStatus']) && $_GET['proStatus'] > 0){
			$proStatus	=    $_GET['proStatus'];
		}
		$sql = "UPDATE property_status SET status = '-7' WHERE idspProStatus = $proStatus  ";
		//$sql		=	"DELETE FROM property_status WHERE idspProStatus = $proStatus";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		$_SESSION['data'] = "success";
		redirect('index.php');			
	}
	
	

?>