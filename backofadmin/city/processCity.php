
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
		
		
		
		
		default :
			redirect('index.php');
	}
	
	// ADD
	function add($dbConn){
		$txtCountry   = mysqli_real_escape_string($dbConn,$_POST['txtCountry']);
		$txtState   = mysqli_real_escape_string($dbConn,$_POST['txtState']);
		$txtTitle   = mysqli_real_escape_string($dbConn,$_POST['txtTitle']);
		
		$sql2 = "SELECT city_id FROM tbl_city WHERE country_id = '$txtCountry' AND state_id = '$txtState' AND city_title = '$txtTitle' ";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=add');	
		}else{
			
			// Insert
			$sql   = "INSERT INTO tbl_city (country_id, state_id, city_title) VALUES ('$txtCountry','$txtState','$txtTitle')";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	function deletee($dbConn){
		if (isset($_GET['cityId']) && $_GET['cityId'] > 0){
			$cityId	=    $_GET['cityId'];
		}
		
		$sql		=	"DELETE FROM tbl_city WHERE city_id = $cityId";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		
		redirect('index.php');			
	}
	
	

	

?>