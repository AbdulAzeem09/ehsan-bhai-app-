
<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';
	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';

	switch ($action) {
		
		case 'block' :
			block($dbConn);
			break;
		case 'unblock' :
			unblock($dbConn);
			break;
		
		default :
			redirect('index.php');
	}
	// UN-BLOCK THIS POST CODE
	function unblock($dbConn){
		if(isset($_GET['postid']) && ($_GET['postid']) > 0 ){
			$postid = $_GET['postid'];

			$sql		=	"UPDATE sppostings SET spPostingVisibility = -1 WHERE idspPostings = $postid";
			$result 	= 	dbQuery($dbConn, $sql);
			if ($result) {
				$sql2 = "DELETE FROM spposting_block WHERE spPostings_idspPostings = '$postid'";
				$result2 = dbQuery($dbConn, $sql2);
				$_SESSION['count'] = 0;
				$_SESSION['data'] = "success";
				$_SESSION['errorMessage'] = "Un-block Successfully";
				redirect("index.php?view=list");
			}
		}else{
			redirect("index.php");
			exit();
		}



	}
	// BLOCK THIS POST CODE
	function block($dbConn){
		$idBlockPost	= mysqli_real_escape_string($dbConn, $_POST['idBlockPost']);
		$txtDesc		= mysqli_real_escape_string($dbConn, $_POST['txtDesc']);
		// 1 is used for block this post

		$sql		=	"UPDATE sppostings SET spPostingVisibility = 1 WHERE idspPostings = $idBlockPost";
		$result 	= 	dbQuery($dbConn, $sql);
		if ($result) {
			$sql3 = "SELECT * FROM spposting_block WHERE spPostings_idspPostings = $idBlockPost";
			$result3 = dbQuery($dbConn, $sql3);
			if ($result3 && dbNumRows($result3) > 0) {
				$sql2 = "UPDATE spposting_block SET spBlockPostNotes = '$txtDesc'";
				$result2 = dbQuery($dbConn, $sql2);

			}else{
				$userId=$_SESSION['userId'];
				$sql2 = "INSERT INTO spposting_block(spPostings_idspPostings, spBlockPostNotes, admin_id) VALUES ('$idBlockPost', '$txtDesc','$userId')";
				$result2 = dbQuery($dbConn, $sql2);
			}
		}
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Updated Successfully.";
		redirect('index.php');			
	}
	
	

	

?>