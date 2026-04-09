<?php
	include('../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="store/";
    include_once ("../authentication/check.php");
    
}else{
	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
//print_r($_POST);	
$cn = new _company_news;

	if(isset($_POST['idcmpanynews'])){

			$cn->updateNews($_POST['cmpanynewsTitle'],$_POST['cmpanynewsDesc'],$_POST['idcmpanynews']);

	}else{
			if (isset($_POST)) {
		
		$cn->create($_POST);
	      }
    
	}
    

    $re = new _redirect;
	$location = $BaseUrl."/job-board/news.php";
    $re->redirect($location);

    //header('location:news.php');
}
?>


