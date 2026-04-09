<?php
	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
    $cn = new _company_news;

    if(!empty($_POST['profileCheck'])) {
	    foreach($_POST['profileCheck'] as $profileId) {
	        //echo $check; 
	        $cn->addMultiNews($_POST['cmpanynewsTitle'], $_POST['cmpanynewsDesc'], $profileId);
	    }
	}

	//$cn->create($_POST);
    
    $re = new _redirect;
    $redirctUrl = "../business-directory/dashboard.php";
    $re->redirect($redirctUrl);
    //header('location:news.php');
    
?>


