
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
		case 'edit' :
			edit($dbConn);
			break;
		default :
			redirect('index.php');
	}
	
	// ADD
	function add($dbConn){
		
		//print_r($_POST);die("dddddddddddd");
		$txtTitle =$_POST['txtTitle'];
		$description =$_POST['description'];
		$user_id_to =$_POST['txtUserLevel'];
		$userId = $_SESSION['userId'];
		$currentDate = date('Y-m-d');

			// Insert
			$sql = "INSERT INTO tbl_notes (`spNotesTitle`, `spNotesDesc`, `spNotesStatus`,`user_id_from`,`spNotesDate`,`user_id_to`) VALUES ('$txtTitle','$description','0','$userId','$currentDate','$user_id_to')";
			//echo $sql; die(" ddddddddddddd");
			$result = dbQuery($dbConn, $sql);
			redirect('index.php?view=add');	
	}
	// DELETE STATE
	function deletee($dbConn){
		if (isset($_GET['stateId']) && $_GET['stateId'] > 0){
			$stateId	=    $_GET['stateId'];
		}
		
		$sql = "UPDATE tbl_state SET status = '-7' WHERE state_id = $stateId";
		//$sql		=	"DELETE FROM tbl_state WHERE state_id = $stateId";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		
		redirect('index.php');			
	}
	// Edit
	function edit($dbConn){
		$idspNotes=$_GET['idspNotes'];
		$txtTitle =$_POST['txtTitle'];
		$description =$_POST['description'];
		$user_id_to =$_POST['txtUserLevel'];
		$sql = "UPDATE `tbl_notes` SET `spNotesTitle`='$txtTitle',`spNotesDesc`='$description',`user_id_to`='$user_id_to' WHERE idspNotes = $idspNotes";
		//echo $sql;die("ddddddddd");
		$result 	= 	dbQuery($dbConn, $sql);
		redirect('index.php');			
	}
	

	

?>