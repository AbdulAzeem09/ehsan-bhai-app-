
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
	
	// MODIFY CATEGORY
	function modify($dbConn){
		$hidId   	= mysqli_real_escape_string($dbConn,$_POST['hidId']);
		$txtTitle   = mysqli_real_escape_string($dbConn,$_POST['txtTitle']);
		
		$sql2 = "SELECT project_id FROM projecttype WHERE project_title = '$txtTitle'";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=modify&projectIypeId='.$hidId);	
		}else{
			
			// Insert
			$sql = "UPDATE projecttype SET project_title = '$txtTitle' WHERE project_id = $hidId";
			//$sql   = "INSERT INTO event_category (speventTitle) VALUES ('$txtTitle')";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// ADD CATEGORY
	function add($dbConn){
		$txtTitle   = mysqli_real_escape_string($dbConn,$_POST['txtTitle']);
		
		$sql2 = "SELECT project_id FROM projecttype WHERE project_title = '$txtTitle'";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=add');	
		}else{
			
			// Insert
			$sql   = "INSERT INTO projecttype (project_title) VALUES ('$txtTitle')";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// delete the project
	function deletee($dbConn) {
		if(isset($_GET['projectIypeId']) && ($_GET['projectIypeId'])>0 ){
			$projectIypeId = $_GET['projectIypeId'];
		}else{
			redirect("index.php");
			exit();
		}
		$sql = "UPDATE projecttype SET status = '-7' WHERE project_id = $projectIypeId ";
		//$sql    =	"DELETE FROM projecttype WHERE project_id ='$projectIypeId'";		
		$result = 	 dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Deleted Successfully";
		redirect("index.php?view=list");
		
	}
	
	

?>