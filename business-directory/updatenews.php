<?php
	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
    $cn = new _company_news;

    $cn->updateNews($_POST['cmpanynewsTitle'], $_POST['cmpanynewsDesc'], $_POST['idcmpanynews']);
	//echo $check; 
	

	//$cn->create($_POST);
    
    $re = new _redirect;
    $redirctUrl = "../business-directory/dashboard.php";
    $re->redirect($redirctUrl);
    //header('location:news.php');
    
?>


