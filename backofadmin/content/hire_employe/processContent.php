
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
		$pageId	= mysqli_real_escape_string($dbConn, $_POST['pageId']);
		$txtDesc =  $_POST['txtDesc'];
		
		$sql = "SELECT * FROM spcontent WHERE contPageId = $pageId";
		$result = dbQuery($dbConn,$sql);
		if (dbNumRows($result) > 0) {
			$sql2 = "UPDATE spcontent SET contDesc = '$txtDesc' WHERE contPageId = $pageId";
		}else{
			$sql2 = "INSERT INTO spcontent(contDesc, contPageId) VALUES ( '$txtDesc', $pageId)";
		}
		//echo $sql2;
		$result2 = dbQuery($dbConn, $sql2);
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Added Successfully.";
		redirect("index.php?view=list");
	
	}
	//modify 
	function modify($dbConn){
		$hidId	= mysqli_real_escape_string($dbConn, $_POST['hidId']);
		$txtDesc = $_POST['txtDesc'];

		$sql = "UPDATE spcontent SET contDesc = '$txtDesc' WHERE idspContent = $hidId";

		$result = dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Updated Successfully.";
		redirect("index.php?view=list");
	
	}
	
	

	

?>