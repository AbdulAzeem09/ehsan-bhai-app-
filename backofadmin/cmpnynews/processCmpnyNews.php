
<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';
	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';

	switch ($action) {
		
		case 'delete' :
			deletee($dbConn);
			break;
		case 'ban' :
			ban($dbConn);
			break;
		
		case 'active' :
			activate($dbConn);
			break;

		default :
			redirect('index.php');
	}
	
	// Ban CATEGORY
	function ban($dbConn){
		$hidId   = mysqli_real_escape_string($dbConn,$_POST['hidId']);
		$txtdesc   = mysqli_real_escape_string($dbConn,$_POST['txtdesc']);
		
		// Insert
		$sql = "UPDATE company_news SET cmpanynewsStatus = 1, banDesc = '$txtdesc' WHERE idcmpanynews = $hidId";
		//$sql   = "INSERT INTO event_category (speventTitle) VALUES ('$txtTitle')";
		$result = dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Ban Successfully.";
		$_SESSION['data'] = "success";
		redirect('index.php');	
	
	}
	// DELETE
	function deletee($dbConn){
		if (isset($_GET['idCmpnyNews']) && $_GET['idCmpnyNews'] > 0){
			$idCmpnyNews	=    $_GET['idCmpnyNews'];
		}
		
		$sql		=	"DELETE FROM company_news WHERE idcmpanynews = $idCmpnyNews";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		
		redirect('index.php');			
	}
	// ACTIVATE NEWS
	function activate($dbConn){
		if (isset($_GET['id']) && $_GET['id'] > 0){
			$id	= $_GET['id'];
		}
		
		$sql = "UPDATE company_news SET cmpanynewsStatus = 0 WHERE idcmpanynews = $id";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Active News Successfully.";
		redirect('index.php');			
	}

	

?>