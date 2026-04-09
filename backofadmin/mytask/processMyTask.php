
<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';
	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';

	switch ($action) {
		
		case 'approve' :
			approve($dbConn);
			break;
		case 'startWork' :
			startWork($dbConn);
			break;
		case 'closeWork' :
			closeWork($dbConn);
			break;
		case 'comment' :
			comment($dbConn);
			break;
		
		default :
			redirect('index.php');
	}

	// COMMENTS IN THE STICKY NOTES
	function comment($dbConn){
		$txtComent		= mysqli_real_escape_string($dbConn, $_POST['txtComent']);
		$txtUserId		= mysqli_real_escape_string($dbConn, $_POST['txtUserId']);
		$txtNoteId		= mysqli_real_escape_string($dbConn, $_POST['txtNoteId']);

		$sql = "INSERT INTO tbl_notes_comment(	commentDetail, idspNotes, user_id)VALUES('$txtComent','$txtNoteId', '$txtUserId')";
		$result = dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Updated Successfully.";
		redirect("index.php?view=detail&noteId=".$txtNoteId);
	}
	// CLOSE WORKING ON SINGLE TASK (0)
	function closeWork($dbConn){
		if(isset($_GET['notesId']) && ($_GET['notesId'])>0 ){
			$notesId = $_GET['notesId'];
		}else{
			redirect("index.php");
			exit();
		}
		
		$sql = "UPDATE tbl_notes SET spNotesStatus = 0 WHERE idspNotes = $notesId";
		//$sql    =	"DELETE FROM tbl_notes WHERE idspNotes ='$noteId'";		
		$result = 	 dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Updated Successfully";
		redirect("index.php?view=list");
	}
	// START WORKING ON SINGLE TASK (-1)
	function startWork($dbConn){
		if(isset($_GET['notesId']) && ($_GET['notesId'])>0 ){
			$notesId = $_GET['notesId'];
		}else{
			redirect("index.php");
			exit();
		}
		
		$sql = "UPDATE tbl_notes SET spNotesStatus = -1 WHERE idspNotes = $notesId";
		//$sql    =	"DELETE FROM tbl_notes WHERE idspNotes ='$noteId'";		
		$result = 	 dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Updated Successfully";
		redirect("index.php?view=list");
	}
	// APPROVE THE TASK
	function approve($dbConn) {
		if(isset($_GET['notesId']) && ($_GET['notesId'])>0 ){
			$notesId = $_GET['notesId'];
		}else{
			redirect("index.php");
			exit();
		}
		
		$sql = "UPDATE tbl_notes SET spNotesStatus = 1 WHERE idspNotes = $notesId";
		//$sql    =	"DELETE FROM tbl_notes WHERE idspNotes ='$noteId'";		
		$result = 	 dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Updated Successfully";
		redirect("index.php?view=list");
		
	}
	
	

	

?>