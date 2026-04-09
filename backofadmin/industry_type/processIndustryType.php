
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
		$indType		= mysqli_real_escape_string($dbConn, $_POST['hidId']);
		$txtIndusrtyType   = mysqli_real_escape_string($dbConn,$_POST['txtIndusrtyType']);

		// update content
		$sql2 = "SELECT idspIndustry FROM industry_type WHERE industryTitle = '$txtIndusrtyType' ";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Item Updated.";
			$_SESSION['data'] = "success";
			redirect('index.php?view=modify&indType='.$indType);	
		}else{
			$sql = "UPDATE industry_type SET industryTitle ='$txtIndusrtyType' WHERE idspIndustry = $indType";
			$result = dbQuery($dbConn, $sql);

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully!";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// ADD
	function add($dbConn){
		$txtIndusrtyType   = mysqli_real_escape_string($dbConn,$_POST['txtIndusrtyType']);
		
		$sql2 = "SELECT idspIndustry FROM industry_type WHERE industryTitle = '$txtIndusrtyType' ";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Item Updated.";
			redirect('index.php?view=add');	
		}else{
			
			// Insert
			$sql   = "INSERT INTO industry_type (industryTitle) VALUES ('$txtIndusrtyType')";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// DELETE THE MAIN CATEGORY
	function deletee($dbConn){
		if (isset($_GET['indType']) && $_GET['indType'] > 0){
			$indType	=    $_GET['indType'];
		}
		
		$sql		=	"DELETE FROM industry_type WHERE idspIndustry = $indType";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		$_SESSION['data'] = "success";
		redirect('index.php');			
	}
	
	

?>