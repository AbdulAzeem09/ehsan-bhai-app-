<style type="text/css">
	input{
		border: none !important;
		background-color: #f9f9f9 !important;
	}
</style>
<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';
	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';

	

	switch ($action) {		
		case 'add' :
			addrow($dbConn);
			break;
		case 'modify' :
			modifyrow($dbConn);
			break;	
	  	case 'edit' :
			editrow($dbConn);
			break;			
		default :
			redirect('index.php');
	}
	//Modify CATEGORY
	function modifyrow($dbConn) {
		// print_r($_POST); exit();
		$commid		= mysqli_real_escape_string($dbConn, $_POST['commid']);
		$commamt  = mysqli_real_escape_string($dbConn,$_POST['commamt']);
		$commtype   = mysqli_real_escape_string($dbConn,$_POST['commtype']);

		// update content
		
		$sql = "UPDATE tbl_admcommission SET comm_type = '$commtype' , comm_amt ='$commamt' WHERE comm_id = $commid";	
		
    	$result = dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Updated Successfully!";
		$_SESSION['data'] = "success";
		redirect('index.php');	
	}
	// ADD CATEGORY
	function addrow($dbConn){
		$commamt  = mysqli_real_escape_string($dbConn,$_POST['commamt']);
		$commtype   = mysqli_real_escape_string($dbConn,$_POST['commtype']);

		$sql2 = "SELECT * FROM tbl_admcommission ORDER BY comm_id DESC LIMIT 1 ";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$sql = "UPDATE tbl_admcommission SET end_date = NOW() ";
			$result = dbQuery($dbConn, $sql);

			$sql3 = "INSERT INTO tbl_admcommission(comm_amt, comm_type)VALUES('$commamt', '$commtype')";
			$result3 = dbQuery($dbConn, $sql3);

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');
		}else{
			$sql3 = "INSERT INTO tbl_admcommission(comm_amt, comm_type)VALUES('$commamt', '$commtype')";
			$result3 = dbQuery($dbConn, $sql3);
			
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');
		}
	}

		//Modify CATEGORY
	function editrow($dbConn) {
		// print_r($_POST); exit();
		$commid		= mysqli_real_escape_string($dbConn, $_POST['commid']);
		$commamt  = mysqli_real_escape_string($dbConn,$_POST['commamt']);
		$commtype   = mysqli_real_escape_string($dbConn,$_POST['commtype']);

		// update content
		
		$sql = "UPDATE tbl_admcommission SET comm_type = '$commtype' , comm_amt ='$commamt' WHERE comm_id = $commid";
		
		

		$result = dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Updated Successfully!";
		$_SESSION['data'] = "success";
		redirect('index.php');	
	}
	

?>