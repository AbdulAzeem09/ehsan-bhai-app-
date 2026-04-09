
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
		$sql2 = "SELECT spJobLevel FROM job_level WHERE jobLevelTitle = '$txtTitle' ";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added!";
			$_SESSION['data'] = "success";
			redirect('index.php?view=modify&jobLvl='.$hidId);	
		}else{
			$sql = "UPDATE job_level SET jobLevelTitle ='$txtTitle' WHERE spJobLevel = $hidId";
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
		
		$sql2 = "SELECT spJobLevel FROM job_level WHERE jobLevelTitle = '$txtTitle' ";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=add');	
		}else{
			
			// Insert
			$sql   = "INSERT INTO job_level (jobLevelTitle) VALUES ('$txtTitle')";
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
		
		$sql = "UPDATE job_level SET status = '-7' WHERE spJobLevel = $id ";
		//$sql		=	"DELETE FROM freelance_profile_type WHERE idspProfileTypeFreelance = $proType";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		$_SESSION['data'] = "success";
		redirect('index.php');			
	}
	
	

?>