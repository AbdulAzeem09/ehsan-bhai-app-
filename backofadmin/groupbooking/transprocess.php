
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
		case 'addremark' :
			addremark($dbConn);
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
		$sql2 = "SELECT idsubCategory FROM subcategory WHERE spCategories_idspCategory = $txtCategory AND subCategoryTitle = '$txtSubCategory'";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully!";
			$_SESSION['data'] = "success";
			redirect('index.php?view=modify&subCat='.$subcatId);	
		}else{
			$sql = "UPDATE subcategory SET subCategoryTitle ='$txtSubCategory', spCategories_idspCategory ='$txtCategory' WHERE idsubCategory = $subcatId";
			$result = dbQuery($dbConn, $sql);

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully!";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// ADD CATEGORY
	function add($dbConn){
		$txtCategory   = mysqli_real_escape_string($dbConn,$_POST['txtCategory']);
		$txtSubCategory   = mysqli_real_escape_string($dbConn,$_POST['txtSubCategory']);
		
		$sql2 = "SELECT idsubCategory FROM subcategory WHERE spCategories_idspCategory = $txtCategory AND subCategoryTitle = '$txtSubCategory'";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=add');	
		}else{
			
			// Insert
			$sql   = "INSERT INTO subcategory (subCategoryTitle, spCategories_idspCategory) VALUES ('$txtSubCategory', '$txtCategory')";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}

		// ADD Remark
	function addremark($dbConn){
		$remark   = mysqli_real_escape_string($dbConn,$_POST['remark']);
		$trans_id   = mysqli_real_escape_string($dbConn,$_POST['trans_id']);
		
		/*$sql2 = "SELECT idsubCategory FROM subcategory WHERE spCategories_idspCategory = $txtCategory AND subCategoryTitle = '$txtSubCategory'";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=add');	
		}else{*/
			
			// Insert
			$sql = "UPDATE spgroupevent_transection SET remark ='$remark' WHERE id = $trans_id";
			$result = dbQuery($dbConn, $sql);
			//$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Remark Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php?view=groupevent');	
		/*}*/
	}
	// DELETE THE MAIN CATEGORY
	function deletee($dbConn){
		if (isset($_GET['subCat']) && $_GET['subCat'] > 0){
			$subCat	=    $_GET['subCat'];
		}
		$sql = "UPDATE subcategory SET subCategoryStatus = '-7' WHERE idsubCategory = $subCat ";
		//$sql		=	"DELETE FROM subcategory WHERE idsubCategory = $subCat";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		$_SESSION['data'] = "success";
		redirect('index.php');			
	}
	
	

?>