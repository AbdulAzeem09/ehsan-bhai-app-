
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
		$payids		= mysqli_real_escape_string($dbConn, $_POST['hidId']);
		$commiAmt = mysqli_real_escape_string($dbConn, $_POST['commiAmt']);

		// update content

			$sql = "update commission_payment_history SET totalComm ='$commiAmt' WHERE payids = $payids";
			$result = dbQuery($dbConn, $sql);

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully!";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		
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
	// DELETE THE MAIN CATEGORY
	function deletee($dbConn){

		$payids		= mysqli_real_escape_string($dbConn, $_GET['payids']);		
		$sql		=	"DELETE FROM commission_payment_history WHERE payids = $payids";
		
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		$_SESSION['data'] = "success";
		redirect('index.php');			
	}
	
	

?>