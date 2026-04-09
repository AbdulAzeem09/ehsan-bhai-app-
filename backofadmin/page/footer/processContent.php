
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
		case 'delete' :
			deletee($dbConn);
			break;
		
		
		default :
			redirect('index.php');
	}

	//Add 
	function add($dbConn){
		$fh_id 		= mysqli_real_escape_string($dbConn, $_POST['txtFootId']);
		$txtTitle	= mysqli_real_escape_string($dbConn, $_POST['txtTitle']);
		$radStatus	= mysqli_real_escape_string($dbConn, $_POST['radStatus']);
		//$txtDesc =  @filterWords($_POST['txtDesc']);
		$txtDesc	= mysqli_real_escape_string($dbConn, @filterWords($_POST['txtDesc']));
		//$txtDesc =  $_POST['txtDesc'];

		$sql = "SELECT * FROM tbl_page WHERE page_title = '$txtTitle'";
		$result = dbQuery($dbConn,$sql);
		if (dbNumRows($result) > 0) {
			$_SESSION['count'] = 0;
			$_SESSION['data'] = "success";
			$_SESSION['errorMessage'] = "Already Exist.";
			//redirect("index.php?view=add");
		}else{
			$sql2 = "INSERT INTO tbl_page(page_title, page_content, status, fh_id) VALUES ( '$txtTitle', '".$txtDesc."', '$radStatus', '$fh_id')";
			$result2 = dbQuery($dbConn, $sql2);
			$_SESSION['count'] = 0;
			$_SESSION['data'] = "success";
			$_SESSION['errorMessage'] = "Added Successfully.";
			redirect("index.php?view=list");
		}
		
	
	}
	//modify 
	function modify($dbConn){
		$hidId		= mysqli_real_escape_string($dbConn, $_POST['hidId']);
		$fh_id 		= mysqli_real_escape_string($dbConn, $_POST['txtFootId']);
		$txtTitle	= mysqli_real_escape_string($dbConn, $_POST['txtTitle']);
		$radStatus	= mysqli_real_escape_string($dbConn, $_POST['radStatus']);
		$txtDesc	= mysqli_real_escape_string($dbConn, @filterWords($_POST['txtDesc']));

		$sql = "SELECT * FROM tbl_page WHERE page_title = '$txtTitle'";
		$result = dbQuery($dbConn,$sql);
		if (isset($result) && dbNumRows($result) > 0 ) {
			$sql2 = "UPDATE tbl_page SET page_content = '$txtDesc', status = '$radStatus', fh_id = '$fh_id' WHERE page_id = $hidId";
		}else{
			$sql2 = "UPDATE tbl_page SET page_title = '$txtTitle', page_content = ' ".$txtDesc."', status = '$radStatus', fh_id = '$fh_id' WHERE page_id = $hidId";
		}
		//echo $sql2;

		$result = dbQuery($dbConn, $sql2);
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Updated Successfully.";
		
		redirect("index.php?view=modify&pageId=".$hidId);
	
	}
	
	function deletee($dbConn) {
		if(isset($_GET['noteId']) && ($_GET['noteId'])>0 ){
			$noteId = $_GET['noteId'];
		}else{
			redirect("index.php");
			exit();
		}
		
		$sql    =	"DELETE FROM tbl_notes WHERE idspNotes ='$noteId'";		
		$result = 	 dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Delted Successfully";
		redirect("index.php?view=list");
		
	}
	
	

	

?>