
<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';
	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';

	switch ($action) {
		
		case 'add' :
			addd($dbConn);
			break;
		case 'approve' :
			approve($dbConn);
			break;
		case 'reject' :
			reject($dbConn);
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
	//modify Category
	function modify($dbConn){
		$hidId	= mysqli_real_escape_string($dbConn, $_POST['hidId']);
		$user_id_to		= mysqli_real_escape_string($dbConn, $_POST['user_id_to']);
		$txtTitle		= mysqli_real_escape_string($dbConn, $_POST['txtTitle']);
		$txtDesc		= mysqli_real_escape_string($dbConn, $_POST['txtDesc']);
		
		$sql = "UPDATE tbl_notes SET spNotesTitle = '$txtTitle', spNotesDesc = '$txtDesc', user_id_to = '$user_id_to' WHERE idspNotes = $hidId";		
		$result = dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Updated Successfully.";
		redirect("index.php?view=list");
	
	}


	//Add Category
	function addd($dbConn){
		$user_id_from	= mysqli_real_escape_string($dbConn, $_POST['user_id_from']);
		$spNotesStatus	= mysqli_real_escape_string($dbConn, $_POST['spNotesStatus']);
		$txtTitle		= mysqli_real_escape_string($dbConn, $_POST['txtTitle']);
		$txtDesc		= mysqli_real_escape_string($dbConn, $_POST['txtDesc']);
		$user_id_to		= mysqli_real_escape_string($dbConn, $_POST['user_id_to']);
		
		
		$sql2 = "INSERT INTO tbl_notes(spNotesTitle, spNotesDesc, spNotesStatus, user_id_from, user_id_to) VALUES
		 ( '$txtTitle', '$txtDesc', '$spNotesStatus', '$user_id_from', '$user_id_to')";
		$result2 = dbQuery($dbConn, $sql2);
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Added Successfully.";
		redirect("index.php?view=list");
	
	}
	// point approved
	function approve($dbConn) {
		if(isset($_GET['noteId']) && ($_GET['noteId'])>0 ){
			$noteId = $_GET['noteId'];
		}else{
			redirect("index.php");
			exit();
		}
		
		$sql = "UPDATE tbl_notes SET spNotesStatus = 2 WHERE idspNotes = $noteId";
		$result = 	 dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Updated Successfully";
		redirect("index.php?view=list");
	}
	// point REJECTED
	function reject($dbConn) {
		if(isset($_GET['noteId']) && ($_GET['noteId'])>0 ){
			$noteId = $_GET['noteId'];
		}else{
			redirect("index.php");
			exit();
		}
		
		$sql = "UPDATE tbl_notes SET spNotesStatus = 0 WHERE idspNotes = $noteId";
		$result = 	 dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Updated Successfully";
		redirect("index.php?view=list");
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