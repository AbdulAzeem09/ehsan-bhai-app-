
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
	//Modify CATEGORY
	function modify($dbConn) {
		$subcatId		= mysqli_real_escape_string($dbConn, $_POST['hidId']);
		$txtCategory   = mysqli_real_escape_string($dbConn, $_POST['txtCategory']);
		$txtSubCategory = mysqli_real_escape_string($dbConn, $_POST['txtSubCategory']);

		// update content
		$sql2 = "SELECT idinsubcategory FROM in_sub_category WHERE idsubCategory = $txtCategory AND insubcatTitle = '$txtSubCategory'";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully!";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}else{
			$sql = "UPDATE in_sub_category SET idsubCategory ='$txtCategory', insubcatTitle ='$txtSubCategory' WHERE idinsubcategory = $subcatId";
			$result = dbQuery($dbConn, $sql);

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully!";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// ADD inSub CATEGORY
	function add($dbConn){
		$txtCategory   = mysqli_real_escape_string($dbConn,$_POST['txtCategory']);
		$txtSubCategory   = mysqli_real_escape_string($dbConn,$_POST['txtSubCategory']);
		
		$sql2 = "SELECT idinsubcategory FROM in_sub_category WHERE idsubCategory = $txtCategory AND insubcatTitle = '$txtSubCategory'";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=add');	
		}else{
			
			// Insert
			$sql   = "INSERT INTO in_sub_category (idsubCategory, insubcatTitle) VALUES ('$txtCategory', '$txtSubCategory')";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// DELETE THE MAIN CATEGORY
	function deletee($dbConn){
		if (isset($_GET['subCat']) && $_GET['subCat'] > 0){
			$subCat	=    $_GET['subCat'];
		}
		$sql = "UPDATE in_sub_category SET insubstatus = '-7' WHERE idinsubcategory = $subCat ";
		//$sql		=	"DELETE FROM in_sub_category WHERE idinsubcategory = $subCat";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		$_SESSION['data'] = "success";
		redirect('index.php');			
	}
	
	

?>