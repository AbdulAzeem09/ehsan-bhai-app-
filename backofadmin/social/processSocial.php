
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
		$txtTitle  = mysqli_real_escape_string($dbConn,$_POST['txtTitle']);
		$txtIcon   = mysqli_real_escape_string($dbConn,$_POST['txtIcon']);
		$radStatus = mysqli_real_escape_string($dbConn,$_POST['radStatus']);
		$txtLink   = mysqli_real_escape_string($dbConn,$_POST['txtLink']);

		
			
		// Insert
		$sql = "UPDATE tbl_social SET spSocTitle = '$txtTitle', spSocIcon = '$txtIcon', spSocLink = '$txtLink', status = '$radStatus' WHERE spSocId = $hidId";	
		$result = dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Updated Successfully.";
		$_SESSION['data'] = "success";
		redirect('index.php');	
		
	}
	// ADD CATEGORY
	function add($dbConn){
		$txtTitle  = mysqli_real_escape_string($dbConn,$_POST['txtTitle']);
		$txtIcon   = mysqli_real_escape_string($dbConn,$_POST['txtIcon']);
		$radStatus = mysqli_real_escape_string($dbConn,$_POST['radStatus']);
		$txtLink   = mysqli_real_escape_string($dbConn,$_POST['txtLink']);
		
		$sql2 = "SELECT spSocId FROM tbl_social WHERE 	spSocTitle = '$txtTitle'";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=add');	
		}else{
			
			// Insert
			$sql   = "INSERT INTO tbl_social (spSocTitle, spSocIcon, spSocLink, status) VALUES ('$txtTitle', '$txtIcon', '$txtLink', '$radStatus')";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// DELETE CATEGORY
	function deletee($dbConn){
		if (isset($_GET['id']) && $_GET['id'] > 0){
			$hidId	=    $_GET['id'];
		}
		
		$sql		=	"DELETE FROM tbl_social WHERE spSocId = $hidId";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		
		redirect('index.php');			
	}
	
	

	

?>