
<?php
	require_once '../../library/config.php';
	require_once '../../library/functions.php';
	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';

	switch ($action) {
		
		case 'add' :
			add($dbConn);
			break;
		case 'modify' :
			modify($dbConn);
			break;
		
		
		default :
			redirect('index.php');
	}

	//Add 
	function add($dbConn){
		$txtModule	= mysqli_real_escape_string($dbConn, $_POST['txtModule']);
		$txtHeading	= mysqli_real_escape_string($dbConn, $_POST['txtHeading']);
		$txtDesc =  $_POST['txtDesc'];
		
		$sql = "SELECT * FROM tbl_posting_content WHERE module_id = $txtModule ";
		$result = dbQuery($dbConn,$sql);
		if (dbNumRows($result) > 0) {
			$_SESSION['count'] = 0;
			$_SESSION['data'] = "success";
			$_SESSION['errorMessage'] = "Already Exist.";
			redirect("index.php?view=add");
		}else{
			$sql2 = "INSERT INTO tbl_posting_content(module_id, pc_title, pc_content) VALUES ( '$txtModule', '$txtHeading', '$txtDesc')";
			$result2 = dbQuery($dbConn, $sql2);
			$_SESSION['count'] = 0;
			$_SESSION['data'] = "success";
			$_SESSION['errorMessage'] = "Added Successfully.";
			redirect("index.php?view=list");
		}
	}
	//modify 
	function modify($dbConn){
		$hidId	= mysqli_real_escape_string($dbConn, $_POST['hidId']);
		$txtModule	= mysqli_real_escape_string($dbConn, $_POST['txtModule']);
		$txtHeading	= mysqli_real_escape_string($dbConn, $_POST['txtHeading']);
		$txtDesc =  $_POST['txtDesc'];

		$sql = "UPDATE tbl_posting_content SET pc_title = '$txtHeading', pc_content = '$txtDesc' WHERE pc_id = $hidId";
		$result = dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Updated Successfully.";
		redirect("index.php?view=list");
	
	}
	
	
	

	

?>