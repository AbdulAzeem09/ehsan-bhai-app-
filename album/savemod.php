<?php
	include('../univ/baseurl.php');
	session_start();

if(!isset($_SESSION['pid'])){ 
	$_SESSION['afterlogin']="timeline/";
	include_once ("../authentication/check.php");  
	
}else{
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$p = new _spAllStoreForm;
	$pid 		= $_SESSION['pid'];
	$uid 		= $_SESSION['uid'];

	if (isset($_POST['btnshowall'])) {
		$freelance = 0;
		$jobboard = 0;
		$realestate = 0;
		$rental = 0;
		$event = 0;
		$art = 0;
		$music = 0;
		$videos = 0;
		$trainings = 0;

		$classfiedads = 0;
        $businessforsale=0;
		$group = 0;
		$directory = 0;
		$news = 0;
		$stores = 0;
		$date = 0;
		
		$nft=0;
		
	}else{
		if (isset($_POST['freelance'])) {
			$freelance 	= 0;
		}else{
			$freelance = 1;
		}
		
		if (isset($_POST['jobboard'])) {
			$jobboard 	= 0;
		}else{
			$jobboard = 1;
		}
		
		if (isset($_POST['realestate'])) {
			$realestate = 0;
		}else{
			$realestate = 1;
		}
		
		if (isset($_POST['event'])) {
			$event 		= 0;
		}else{
			$event = 1;
		}

		if (isset($_POST['artgallery'])) {
			$art 		= 0;
		}else{
			$art = 1;
		}
		
		if (isset($_POST['music'])) {
			$music 		= 0;
		}else{
			$music = 1;
		}
		
		if (isset($_POST['video'])) {
			$videos 	= 0;
		}else{
			$videos = 1;
		}
		
		if (isset($_POST['trainging'])) {
			$trainings 	= 0;
		}else{
			$trainings = 1;
		}

		if (isset($_POST['group'])) {
			$group 		= 0;
		}else{
			$group = 1;
		}
		
		if (isset($_POST['service'])) {
			$directory 	= 0;
		}else{
			$directory = 1;
		}

		if (isset($_POST['news'])) {
			$news 	= 0;
		}else{
			$news = 1;
		}

		if (isset($_POST['stores'])) {
			$stores 	= 0;
		}else{
			$stores = 1;
		}

		if (isset($_POST['date'])) {
			$date 	= 0;
		}else{
			$date = 1;
		}

		if (isset($_POST['classfiedads'])) {
			$classfiedads 	= 0;
		}else{
			$classfiedads = 1;
		}

		if (isset($_POST['rental'])) {
			$rental 	= 0;
		}else{
			$rental = 1;
		}
		if (isset($_POST['nft'])) {
			$nft 	= 0;
		}else{
			$nft = 1;
		}
		if (isset($_POST['businessforsale'])) {
			$businessforsale 	= 0;
		}else{
			$businessforsale = 1;
		}




	}

	$result = $p->chekModExit($pid, $uid);
	if ($result) {
		// donot perform any task.
	}else{
		$p->createModShow($pid, $uid);
	}
	
	$data = array("freelance" => $freelance,"jobboard" => $jobboard,"realestate" => $realestate, "event" => $event, "art" => $art,"music" => $music,"videos" => $videos, "trainings" => $trainings, "groups" => $group, "directory" => $directory,"news" => $news,"stores" => $stores,"date" => $date,"classified_ads" => $classfiedads,"rental" => $rental,"nft" => $nft,"businessforsale" => $businessforsale );

	$p->updateModShow($data ,$pid, $uid);
	//echo $p->ms->sql;
	// UPDATE THE FIRST LOGIN TO 1 
	$t = new _firstlogin;
	$result2 = $t->updateVis($uid);

	//echo $p->ms->sql;
	$re = new _redirect;
	$redirctUrl = $BaseUrl . "/timeline/";
	$re->redirect($redirctUrl);

}
?>
