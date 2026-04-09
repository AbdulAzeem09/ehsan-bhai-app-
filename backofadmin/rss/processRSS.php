
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
		$rss_id			= mysqli_real_escape_string($dbConn, $_POST['hidId']);
		$website_name   = mysqli_real_escape_string($dbConn,$_POST['website_name']);
		$website_link 	= mysqli_real_escape_string($dbConn, $_POST['website_link']);
		$country        = mysqli_real_escape_string($dbConn,$_POST['country']);
		$category       = mysqli_real_escape_string($dbConn,$_POST['category']);
		$rss_status 	= '1';
		
		// update content
		$sql2 = "SELECT rss_id FROM rss_data WHERE website_link = '$website_link'";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){

			$sql = "UPDATE rss_data SET  website_name='$website_name',country='$country',category='$category', rss_status= $rss_status WHERE rss_id = $rss_id";
			$result = dbQuery($dbConn, $sql);

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully!";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}else{
			$sql = "UPDATE rss_data SET website_name='$website_name',country='$country',category='$category', rss_status= $rss_status WHERE rss_id = $rss_id";
			$result = dbQuery($dbConn, $sql);

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully!";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// ADD CATEGORY
	function add($dbConn){
		$website_name   = mysqli_real_escape_string($dbConn,$_POST['website_name']);
		$website_link   = mysqli_real_escape_string($dbConn,$_POST['website_link']);
		$country        = mysqli_real_escape_string($dbConn,$_POST['country']);
		$category       = mysqli_real_escape_string($dbConn,$_POST['category']);
		$sql2 = "SELECT rss_id FROM rss_data WHERE website_link = '$website_link'";
		$result2 = dbQuery($dbConn, $sql2);
		if(dbNumRows($result2) > 0){
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Already Added.";
			redirect('index.php?view=add');	
		}else{
			
			// Insert
			$sql   = "INSERT INTO rss_data (website_name, website_link, country, category, rss_status) VALUES
			          ('$website_name', '$website_link','$country','$category', '1')";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Added Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}
	}
	// DELETE THE MAIN CATEGORY
	function deletee($dbConn){
		if (isset($_GET['rss_id']) && $_GET['rss_id'] > 0){
			$rss_id	=    $_GET['rss_id'];
		}
		
		$sql = "UPDATE rss_data SET rss_status = '2' WHERE rss_id = $rss_id ";
		//$sql		=	"DELETE FROM rss_data WHERE rss_id = $rss_id";
		$result 	= 	dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		$_SESSION['data'] = "success";
		redirect('index.php');			
	}
	
?>