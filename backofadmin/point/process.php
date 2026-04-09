
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
		default :
			redirect('index.php');
	}
	//Modify CATEGORY
	function modifyrow($dbConn) {
		$hidId		= mysqli_real_escape_string($dbConn, $_POST['hidId']);
		$txtPointType   = strtolower(mysqli_real_escape_string($dbConn,$_POST['txtPointType']));
		$txtPoint   = mysqli_real_escape_string($dbConn,$_POST['txtPoint']);
		$txtPercent = mysqli_real_escape_string($dbConn, $_POST['txtPercent']);
		$spent_amount = mysqli_real_escape_string($dbConn, $_POST['spent_amount']);

		// update content
		$sql2 = "SELECT * FROM tbl_point WHERE pt_id = '$txtPointType' AND point_id != '$hidId'";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$sql = "UPDATE tbl_point SET  spent_amount ='$spent_amount', point_total ='$txtPoint', percent = $txtPercent WHERE point_id = $hidId";
			
		}else{
			$sql = "UPDATE tbl_point SET spent_amount ='$spent_amount',pt_id ='$txtPointType', point_total ='$txtPoint', percent = $txtPercent WHERE point_id = $hidId";
			
		}

		$result = dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Updated Successfully!";
		$_SESSION['data'] = "success";
		redirect('index.php');	
	}
	// ADD CATEGORY
	function addrow($dbConn){
		$txtPointType   = strtolower(mysqli_real_escape_string($dbConn,$_POST['txtPointType']));
		$txtPoint   = mysqli_real_escape_string($dbConn,$_POST['txtPoint']);
		$txtPercent = mysqli_real_escape_string($dbConn, $_POST['txtPercent']);
		$spent_amount = mysqli_real_escape_string($dbConn, $_POST['spent_amount']);
		
		$sql2 = "SELECT * FROM tbl_point WHERE pt_id = '$txtPointType' ";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=add');	
		}else{
			
			// Insert
			$sql   = "INSERT INTO tbl_point (pt_id, point_total, percent,spent_amount) VALUES ('$txtPointType', '$txtPoint', '$txtPercent','$spent_amount')";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}

	

?>