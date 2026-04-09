
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
		$hidId   = mysqli_real_escape_string($dbConn,$_POST['hidId']);
		$txtTitle   = mysqli_real_escape_string($dbConn,$_POST['txtTitle']);
		
		$sql2 = "SELECT id FROM post_guideline WHERE post_title = '$txtTitle'";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=modify&jobPost='.$hidId);	
		}else{
			
			// Insert
			$sql = "UPDATE post_guideline SET post_title = '$txtTitle' WHERE id = $hidId";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// ADD CATEGOR
	function add($dbConn){
		$txtTitle   = mysqli_real_escape_string($dbConn,$_POST['txtTitle']);
		
		$sql2 = "SELECT id FROM post_guideline WHERE post_title = '$txtTitle'";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=add');	
		}else{
			// Insert
			$sql   = "INSERT INTO post_guideline (post_title) VALUES ('$txtTitle')";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// DELETE THE FUNCTION
	function deletee($dbConn){
		if (isset($_GET['jobPost']) && $_GET['jobPost'] > 0){
			$JobPost	=    $_GET['jobPost'];
		}
		
		$sql		=	"DELETE FROM post_guideline WHERE id = $JobPost";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		
		redirect('index.php');			
	}
	
	

	

?>