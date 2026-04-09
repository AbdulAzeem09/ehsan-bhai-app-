
<?php
	require_once '../../library/config.php';
	require_once '../../library/functions.php';
	include_once '../../../mlayer/_realstatepic.class.php';
	include_once '../../../mlayer/_tableadapter.class.php';
	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';
   
	switch ($action) {
		
		case 'add' :
			add($dbConn);
			break;
		case 'modify' :
			modify($dbConn);
			break;
            case 'delete' :
                deletee($dbConn);
                break;
		default :
			redirect('index.php');
	}

	//Add 
	function add($dbConn){
	
		$filename='';
		
		include '../../../univ/baseurl.php';  
		$upload_location = $_SERVER['DOCUMENT_ROOT'].'/uploadimage/';
		
		if (isset($_POST['btnButton'])) {
			$filename = $_FILES["choosefile"]["name"];
		    $tempname = $_FILES["choosefile"]["tmp_name"];    
		}
	
		$s3Class = new s3Class(3);	
		$pathInfo = pathinfo($filename);
		$extension = $pathInfo['extension'];
		$bucket = $s3Class->addS3Image($tempname,$extension);
		$urll = $bucket['url'];
		 
		if (isset($_POST['name'])) {
			$name = $_POST['name'];
		}
		if (isset($_POST['designation'])) {
        	$designation = $_POST['designation'];
		}
		if (isset($_POST['youtubeUrl'])) {
			$txtDesc = $_POST['youtubeUrl'];
		}
		$sql2 =	insertQ("insert into spvideotestimonial(name, designation , image , youtubeUrl ) values(?, ?, ?, ?)", "ssss", [$name, $designation, $urll, $txtDesc]);	
		
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Added Successfully.";
		redirect("index.php?view=list");
	
	}
	//modify 
	function modify($dbConn){
		$filename='';
		include '../../../univ/baseurl.php';  
		$upload_location = $_SERVER['DOCUMENT_ROOT'].'/uploadimage/';
		
		if (isset($_POST['btnButton'])) {
			$filename = $_FILES["choosefile"]["name"];
			$tempname = $_FILES["choosefile"]["tmp_name"];
		}
		
		if (isset($_FILES["choosefile"]["tmp_name"]) && $_FILES["choosefile"]["tmp_name"] != "") {
			$s3Class = new s3Class(3);	
			
			$pathInfo = pathinfo($filename);
			$extension = $pathInfo['extension'];
			$bucket = $s3Class->addS3Image($tempname,$extension);
			$urll = $bucket['url'];
		}
		$hidId	= mysqli_real_escape_string($dbConn, $_POST['hidId']);
		if (isset($_POST['name'])) {
			$name = $_POST['name'];
		}
		if (isset($_POST['designation'])) {
        	$designation = $_POST['designation'];
		}
		if (isset($_POST['youtubeUrl'])) {
			$txtDesc = $_POST['youtubeUrl'];
		}
		if (isset($_FILES["choosefile"]["tmp_name"]) && $_FILES["choosefile"]["tmp_name"] != "") {
			$sql = insertQ("UPDATE `spvideotestimonial` SET name=?, designation=?, image=?, youtubeUrl=? WHERE id=?", "ssssi", [$name, $designation, $urll,$txtDesc, $hidId]);
        }else{
			$sql = insertQ("UPDATE `spvideotestimonial` SET name=?, designation=?, youtubeUrl=? WHERE id=?", "sssi", [$name, $designation,$txtDesc, $hidId]);
		}

		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Updated Successfully.";
		redirect("index.php?view=list");
	
	}

    function deletee($dbConn) {
		
		if(isset($_GET['conId']) && ($_GET['conId'])>0 ){
			$conId = $_GET['conId'];
		}else{
			redirect("index.php");
			exit();
		}
		$sql = insertQ("DELETE FROM spvideotestimonial  WHERE id=?", "i", [$conId]);		
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Delted Successfully";
		redirect("index.php?view=list");
		
	}


?>