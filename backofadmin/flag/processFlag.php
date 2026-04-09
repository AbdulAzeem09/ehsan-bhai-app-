
<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';
	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';

	switch ($action) {
		
		case 'addflag' :
			addflag($dbConn);
			break;
		
		
		default :
			redirect('index.php');
	}
	
	// ADD CATEGORY
	function addflag($dbConn){
		$flager_pid   = mysqli_real_escape_string($dbConn,$_POST['flager_pid']);
		$poster_pid   = mysqli_real_escape_string($dbConn,$_POST['poster_pid']);
		$postid   	  = mysqli_real_escape_string($dbConn,$_POST['postid']);
		$productid   	  = mysqli_real_escape_string($dbConn,$_POST['product_id']);
		$whichReason  = mysqli_real_escape_string($dbConn,$_POST['whichReason']);
		$txtReason    = mysqli_real_escape_string($dbConn,$_POST['txtReason']);
		$flagId    = mysqli_real_escape_string($dbConn,$_POST['flagId']);
		$module    = mysqli_real_escape_string($dbConn,$_POST['module']);
		$catid    = mysqli_real_escape_string($dbConn,$_POST['catid']);
		
		if ($whichReason == 1) {
			// warning poster 
			
			
			$sql = "UPDATE flagpost SET flag_status = 1 , admin_comment = '$txtReason' WHERE flag_id = $flagId";
			$result = dbQuery($dbConn, $sql);

			$sql2 = "UPDATE sppostings SET spPostingVisibility = -1 WHERE idspPostings = $postid";
			$result2 = dbQuery($dbConn, $sql2);

			// send email poster with warning


			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php?catId='.$catid);	
		}else if($whichReason == 2){
			 
			// warning flager
			$sql = "UPDATE flagpost SET flag_status = 1 , admin_comment = '$txtReason' WHERE flag_id = $flagId";
			$result = dbQuery($dbConn, $sql);

			$sql2 = "UPDATE sppostings SET spPostingVisibility = -1 WHERE idspPostings = $postid";
			$result2 = dbQuery($dbConn, $sql2);

			// send email to flager
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php?catId='.$catid);
		}else if($whichReason == 3){
			// warning flager
			//$sql = "UPDATE flagpost SET flag_status = 1 , admin_comment = '$txtReason' WHERE flag_id = $flagId";
			//$result = dbQuery($dbConn, $sql);
			// disable this post
			//$sql2 = "UPDATE sppostings SET spPostingVisibility = 5 WHERE idspPostings = $postid";
			//$result2 = dbQuery($dbConn, $sql2);
			
			if($module=='store')
			{
             $sql3 = "UPDATE spproduct SET spPostingsFlag = 1  WHERE idspPostings = $productid";
			$result3 = dbQuery($dbConn, $sql3);
			}
			if($module=='freelancer')
			{
             $sql3 = "UPDATE spfreelancer SET spPostingsFlag = 1  WHERE idspPostings = $postid";
			$result3 = dbQuery($dbConn, $sql3);
			}
			if($module=='jobboard')
			{
             $sql3 = "UPDATE  spjobboard SET flag_status = 1  WHERE idspPostings = $postid";
			$result3 = dbQuery($dbConn, $sql3);
			}
				if($module=='realestate')
			{
             $sql3 = "UPDATE  sprealstate SET flag_status = 1  WHERE idspPostings = $postid";
			$result3 = dbQuery($dbConn, $sql3);
			}
				if($module=='event')
			{
             $sql3 = "UPDATE  spevent SET flag_status = 1  WHERE idspPostings = $postid";
			$result3 = dbQuery($dbConn, $sql3);
			}
				if($module=='artcraft')
			{
             $sql3 = "UPDATE  sppostingsartcraft SET flag_status = 1  WHERE idspPostings = $productid";
			$result3 = dbQuery($dbConn, $sql3);
			}
			if($module=='video')
			{
             $sql3 = "UPDATE  spvideo SET flag_status = 1  WHERE idspPostings = $productid";
			$result3 = dbQuery($dbConn, $sql3);
			}
			if($module=='classified')
			{
             $sql3 = "UPDATE  spclassified SET flag_status = 1  WHERE idspPostings = $productid";
			$result3 = dbQuery($dbConn, $sql3);
			}
			
			// send email to poster to disable this product
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php?catId='.$catid); 
		}
		else if($whichReason == 4){   
			// warning flager
			//$sql = "UPDATE flagpost SET flag_status = 1 , admin_comment = '$txtReason' WHERE flag_id = $flagId";
			//$result = dbQuery($dbConn, $sql);
			// disable this post
			$sql2 = "UPDATE sppostings SET spPostingVisibility = 5 WHERE idspPostings = $postid";
			$result2 = dbQuery($dbConn, $sql2);
			if($module=='store')
			{
             $sql3 = "UPDATE spproduct SET spPostingsFlag = 2  WHERE idspPostings = $productid";
			$result3 = dbQuery($dbConn, $sql3);
			}
			if($module=='freelancer')
			{
             $sql3 = "UPDATE spfreelancer SET spPostingsFlag = 2  WHERE idspPostings = $postid";
			$result3 = dbQuery($dbConn, $sql3);
			}
			if($module=='jobboard')
			{
             $sql3 = "UPDATE  spjobboard SET flag_status = 2  WHERE idspPostings = $postid";
			$result3 = dbQuery($dbConn, $sql3);
			}
			if($module=='realestate')
			{
             $sql3 = "UPDATE  sprealstate SET flag_status = 2  WHERE idspPostings = $postid";
			$result3 = dbQuery($dbConn, $sql3);
			}
			if($module=='event')
			{
             $sql3 = "UPDATE  spevent SET flag_status = 2  WHERE idspPostings = $postid";
			$result3 = dbQuery($dbConn, $sql3);
			}
			if($module=='artcraft')
			{
             $sql3 = "UPDATE  sppostingsartcraft SET flag_status = 2  WHERE idspPostings = $postid";
			$result3 = dbQuery($dbConn, $sql3);
			}
			if($module=='video')
			{
             $sql3 = "UPDATE  spvideo SET flag_status = 2  WHERE idspPostings = $productid";
			$result3 = dbQuery($dbConn, $sql3);
			}
			if($module=='classified')
			{
             $sql3 = "UPDATE  spclassified SET flag_status = 2  WHERE idspPostings = $productid";
			$result3 = dbQuery($dbConn, $sql3);
			}
			// send email to poster to disable this product
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php?catId='.$catid);
		}
		else {
			 
			// warning flager
			$sql = "UPDATE flagpost SET flag_status = 1 , admin_comment = '$txtReason' WHERE flag_id = $flagId";
			$result = dbQuery($dbConn, $sql);
			// disable this post
			$sql2 = "UPDATE sppostings SET spPostingVisibility = -1 WHERE idspPostings = $postid";
			$result2 = dbQuery($dbConn, $sql2);
        $sql3 = "UPDATE spproduct SET Status = 1  WHERE idspPostings = $productid";
			$result3 = dbQuery($dbConn, $sql3);
			// send email to flager
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Updated Successfully.";
			$_SESSION['data'] = "success";
			redirect('index.php?catId='.$catid);
		}


		
	}
	
	
	

	

?>