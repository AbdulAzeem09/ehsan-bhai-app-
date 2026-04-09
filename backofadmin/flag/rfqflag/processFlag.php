
<?php
	require_once '../../library/config.php';
	require_once '../../library/functions.php';
	checkUser();

	
	$action = isset($_GET['action']) ? $_GET['action'] : '';

	//echo $action;

	switch ($action) {
		
		case 'addflag' :
			addflag($dbConn);
			break;
		
		
		default :
			redirect('index.php');
	}


	//echo "here";
	
	// ADD CATEGORY
	function addflag($dbConn){
		$flager_pid   = mysqli_real_escape_string($dbConn,$_POST['flager_pid']);
		$poster_pid   = mysqli_real_escape_string($dbConn,$_POST['poster_pid']);
		$postid   	  = mysqli_real_escape_string($dbConn,$_POST['postid']);
		$whichReason  = mysqli_real_escape_string($dbConn,$_POST['whichReason']);
		$txtReason    = mysqli_real_escape_string($dbConn,$_POST['txtReason']);
		$flagId    = mysqli_real_escape_string($dbConn,$_POST['flagId']);
		//$catid    = mysqli_real_escape_string($dbConn,$_POST['catid']);

		//print_r($flager_pid);
		//print_r($postid);
		//print_r($whichReason);
		//print_r($txtReason);
		//print_r($flagId);

		//echo "here";
		
		if ($whichReason == 1) {
			// warning poster 
			$sql = "UPDATE rfqflag SET flag_status = 1 , admin_comment = '$txtReason' WHERE id = $flagId";

			$result = dbQuery($dbConn, $sql);

			$sql2 = "UPDATE sppostings SET spPostingVisibility = -1 WHERE idspPostings = $postid";

			$result2 = dbQuery($dbConn, $sql2);

			// send email poster with warning

            echo $sql;

			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');	
		}else if($whichReason == 2){
			// warning flager
			$sql = "UPDATE rfqflag SET flag_status = 1 , admin_comment = '$txtReason' WHERE id = $flagId";
			$result = dbQuery($dbConn, $sql);

			$sql2 = "UPDATE sppostings SET spPostingVisibility = -1 WHERE idspPostings = $postid";
			$result2 = dbQuery($dbConn, $sql2);

			 echo $sql;

			// send email to flager
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');
		}else if($whichReason == 3){
			// warning flager
			$sql = "UPDATE rfqflag SET flag_status = 1 , admin_comment = '$txtReason' WHERE id = $flagId";
			$result = dbQuery($dbConn, $sql);
			// disable this post
			$sql2 = "UPDATE sppostings SET spPostingVisibility = 5 WHERE idspPostings = $postid";
			$result2 = dbQuery($dbConn, $sql2);
      $sql = "UPDATE spproduct SET spPostingsFlag = 1  WHERE idspPostings = $postid";
			$result = dbQuery($dbConn, $sql);
			// send email to poster to disable this product
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');
		}
		
		else if($whichReason == 4){
			// warning flager
			$sql = "UPDATE rfqflag SET flag_status = 1 , admin_comment = '$txtReason' WHERE id = $flagId";
			$result = dbQuery($dbConn, $sql);
			// disable this post
			$sql2 = "UPDATE sppostings SET spPostingVisibility = 5 WHERE idspPostings = $postid";
			$result2 = dbQuery($dbConn, $sql2);
      $sql = "UPDATE spproduct SET spPostingsFlag = 2  WHERE idspPostings = $postid";
			$result = dbQuery($dbConn, $sql);
			// send email to poster to disable this product
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');
		}
		else {
			// warning flager
			$sql = "UPDATE rfqflag SET flag_status = 1 , admin_comment = '$txtReason' WHERE id = $flagId";
			$result = dbQuery($dbConn, $sql);
			// disable this post
			$sql2 = "UPDATE sppostings SET spPostingVisibility = -1 WHERE idspPostings = $postid";
			$result2 = dbQuery($dbConn, $sql2);

			// send email to flager
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php');
		}


		
	}
	
	
	

	

?>