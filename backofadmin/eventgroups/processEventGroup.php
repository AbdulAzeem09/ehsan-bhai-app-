
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
		$id   = mysqli_real_escape_string($dbConn,$_POST['id']);
		$txtTitle   = mysqli_real_escape_string($dbConn,$_POST['grptxtTitle']);
		$catids   = $_POST['catids'];
		$texcatids = implode(",",$catids);
		
		$sql2 = "SELECT idspeventgr FROM event_groups WHERE speventGropupTitle = '$txtTitle' and idspeventgr != '$id'";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "This Event Gropup Already Added.";
			redirect('index.php?view=modify&id='.$id);	
		}else{
			
			// Insert
			 $sql = "UPDATE event_groups SET speventGropupTitle = '$txtTitle', event_category_ids = '$texcatids' WHERE idspeventgr = $id";
			
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// ADD CATEGORY
	function add($dbConn){
		
			
		$txtTitle   = mysqli_real_escape_string($dbConn,$_POST['grptxtTitle']);
		$catids   = $_POST['catids'];
		$texcatids = implode(",",$catids);
	
		$sql2 = "SELECT idspeventgr FROM event_groups WHERE speventGropupTitle = '$txtTitle'";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "This Event Gropup Already Added.";
			redirect('index.php?view=add');	
		}else{
			
			// Insert
			$sql   = "INSERT INTO event_groups (speventGropupTitle,event_category_ids,status) VALUES ('$txtTitle','$texcatids','1')";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Event Gropup Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// DELETE CATEGORY
	function deletee($dbConn){
		if (isset($_GET['idspeventgr']) && $_GET['idspeventgr'] > 0){
			$idspeventgr	=    $_GET['idspeventgr'];
		}
		
		$sql = "delete from event_groups WHERE idspeventgr = '$idspeventgr'";
			$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Event Gropup Deleted Successfully.";
		
		redirect('index.php');			
	}
	
	

	

?>