
<?php
	include('../univ/baseurl.php');
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$r = new _sppostreview;

	$re = new _redirect;
    

	$folder = $_SESSION['folder'];
	unset($_SESSION['folder']);

	$res = $r->read($_POST["spPostings_idspPostings"],$_POST["spProfiles_idspProfiles"]);
	if($res != false){
		
		$r->updatereview($_POST["spPostings_idspPostings"],$_POST["spProfiles_idspProfiles"],$_POST["spPostReviewText"],$_POST["spPostRating"]);
		if(isset($_POST["flag_"])){

			$redirctUrl = $BaseUrl.'/'.$folder."/detail.php?catid=1&postid=".$_POST["spPostings_idspPostings"];
    		$re->redirect($redirctUrl);
			//header("Location:../".$folder."/detail.php?catid=1&postid=".$_POST["spPostings_idspPostings"]."");
		}else{
			$redirctUrl = $BaseUrl.'/'.$folder."/detail.php?catid=1&postid=".$_POST["spPostings_idspPostings"];
			$re->redirect($redirctUrl);
			//header("Location:../".$folder."/detail.php?catid=1&postid=".$_POST["spPostings_idspPostings"]."");
		}
	}else{
		$r->create($_POST);
		$result = $r->review($_POST["spPostings_idspPostings"]);
		if($result != false){
			$review = $result->num_rows;
			echo $review;
		}else{
			$review = 0;
			echo $review;
		}
		if(isset($_POST["flag_"])){
			$redirctUrl = $BaseUrl.'/'.$folder."/detail.php?catid=1&postid=".$_POST["spPostings_idspPostings"];
			$re->redirect($redirctUrl);
			//header("Location:../".$folder."/detail.php?catid=1&postid=".$_POST["spPostings_idspPostings"]."");
		}else{
			$redirctUrl = $BaseUrl.'/'.$folder."/detail.php?catid=1&postid=".$_POST["spPostings_idspPostings"];
			$re->redirect($redirctUrl);
			//header("Location:../".$folder."/detail.php?catid=1&postid=".$_POST["spPostings_idspPostings"]."");
		}
	}

		
?>
