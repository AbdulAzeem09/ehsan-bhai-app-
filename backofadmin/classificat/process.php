
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
		
		//default :
		//	redirect('index.php');
	}
	// MODIFY CATEGORY
	function modify($dbConn){

		$hidId   = mysqli_real_escape_string($dbConn,$_POST['hidId']);
		$txtTitle   = mysqli_real_escape_string($dbConn,$_POST['txtTitle']);
		$txtType =mysqli_real_escape_string($dbConn,$_POST['txtType']);
		
		//$sql2 = "SELECT idclasified FROM clasified_category WHERE clasifiedTitle = '$txtTitle'";
		//$result2 = dbQuery($dbConn, $sql2);
		//if(dbNumRows($result2) > 0){
			//$_SESSION['count'] = 0;
			//$_SESSION['errorMessage'] = "Already Added.";
			//redirect('index.php?view=modify&ArtCat='.$hidId);
		//}else{
			
			// Insert
			  $sql = "UPDATE clasified_category SET clasifiedTitle = '$txtTitle',clasifiedType= '$txtType' WHERE idclasfied = $hidId";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');
		//}
	}
	// ADD CATEGORY
	function add($dbConn){
		$txtType   = mysqli_real_escape_string($dbConn,$_POST['txtType']);
		$txtTitle  = mysqli_real_escape_string($dbConn,$_POST['txtTitle']);
		
		$sql2 = "SELECT idclasfied FROM clasified_category WHERE clasifiedTitle = '$txtTitle' AND clasifiedType = $txtType ";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=add');	
		}else{
			// Insert
			$sql   = "INSERT INTO clasified_category (clasifiedTitle, clasifiedType) VALUES ('$txtTitle', $txtType)";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// DELETE THE FUNCTION
	function deletee($dbConn){
		if (isset($_GET['subCat']) && $_GET['subCat'] > 0){
			$ArtCat	=    $_GET['subCat'];
		}
		
		$sql		=	"DELETE FROM clasified_category WHERE idclasfied = $ArtCat";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		
		redirect('index.php');			
	}
	
	

	

?>