
<?php
	include('../univ/baseurl.php');
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$fps = new _freelance_project_status;

	if(isset($_GET['postid']) && $_GET['postid'] > 0 && isset($_GET['pid']) && $_GET['pid'] >0){
		$spPosting_idspPostings = $_GET['postid'];
		$spProfiles_idspProfiles = $_GET['pid'];
		$price = $_GET['price'];
		//$fps_status = $_GET['accept'];
		//echo $_GET['statu'];

		if($_GET['status'] == 'accept'){
			$fps_status ="Acepted";
		}else{
			$fps_status = "Rejected";
		}
		$fps_start_date = date('Y m d');
		$chkAlready = $fps->checkStatusExist($spPosting_idspPostings);
		$conn = _data::getConnection();
		if($chkAlready == false){
			
			$sql = "INSERT INTO freelance_project_status(spProfiles_idspProfiles, spPosting_idspPostings, fps_start_date, fps_status, fps_price) VALUES('$spProfiles_idspProfiles', '$spPosting_idspPostings', Now(), '$fps_status', $price)";
			$result = mysqli_query($conn, $sql);
	        if($result){
	        	header('location:'.$BaseUrl.'/freelancer/projects.php');
	        }
			
		}else{
			echo $sql = "UPDATE freelance_project_status SET spProfiles_idspProfiles = '$spProfiles_idspProfiles',spPosting_idspPostings = '$spPosting_idspPostings', fps_start_date = NOW(), fps_status = '$fps_status'  WHERE spPosting_idspPostings = '$spPosting_idspPostings'";
			$result = mysqli_query($conn, $sql);
			if($result){
				header('location:'.$BaseUrl.'/freelancer/projects.php');
			}
			
		}
	}

	
?>
