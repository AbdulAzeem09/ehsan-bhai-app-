
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
		$txtTitle   = strtolower(mysqli_real_escape_string($dbConn,$_POST['txtTitle']));
		

		// update content
		$sql2 = "SELECT * FROM tbl_point_type WHERE pt_title = '$txtTitle' AND pt_id != '$hidId'";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Exist";
			$_SESSION['data'] = "success";
			redirect('index.php?view=modify&id='.$hidId);	
		}else{
			$sql = "UPDATE tbl_point_type SET  pt_title ='$txtTitle' WHERE pt_id = $hidId";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully!";
			$_SESSION['data'] = "success";
			redirect('index.php');

			
		}

	}
	// ADD CATEGORY
	function addrow($dbConn){
		$txtTitle   = strtolower(mysqli_real_escape_string($dbConn,$_POST['txtTitle']));
		
		$sql2 = "SELECT * FROM tbl_point_type WHERE pt_title = '$txtTitle' ";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=add');	
		}else{
			
			// Insert
			$sql   = "INSERT INTO tbl_point_type (pt_title) VALUES ('$txtTitle')";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// DELETE THE MAIN CATEGORY
	function deletee($dbConn){
		if (isset($_GET['id']) && $_GET['id'] > 0){
			$id	=    $_GET['id'];
		}
		
		$sql = "UPDATE tbl_point_type SET status = '-7' WHERE pt_id = $id ";
		//$sql		=	"DELETE FROM tbl_point_type WHERE pt_id = $id";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		$_SESSION['data'] = "success";
		redirect('index.php');			
	}
	
	

?>