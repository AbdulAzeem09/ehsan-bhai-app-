
<?php
	include('../univ/baseurl.php');
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$p = new _postings;

	if(isset($_GET['postid']) && $_GET['postid'] ){
		if(isset($_GET['action']) && $_GET['action'] == 'complete'){
			$spPostingStatus = "Completed";
			$spPosting_idspPostings = $_GET['postid'];
			$result = $p->projectStatus($spPosting_idspPostings, $spPostingStatus);
			//echo $p->ta->sql;
			$redirect = $BaseUrl.'/freelancer/active-bid.php';
			header('location:'.$redirect);

		}
	}else if(isset($_POST['btnCancel'])){
		$spPostingStatus = "Canceled";
		$spPosting_idspPostings = $_POST['spPosting_idspPostings'];
		$description = $_POST['txtCancelDescription'];
		$result = $p->cancelprojectStatus($spPosting_idspPostings, $spPostingStatus, $description);

		$redirect = $BaseUrl.'/freelancer/active-bid.php';
		header('location:'.$redirect);

	}else{
		header('location:'.$BaseUrl.'/freelancer/');
	}

	
?>
