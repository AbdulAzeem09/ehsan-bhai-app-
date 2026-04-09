<?php
    include('../univ/baseurl.php');

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $p = new _postings;
  
    if (isset($_GET['postid']) && $_GET['postid'] > 0) {
    	$postid = $_GET['postid'];
    	$result = $p->remove($postid);

    	$re = new _redirect;
    	if ($_GET['action'] == 'del') {
    		$redirctUrl = $BaseUrl . "/store/my-product.php";
    	}else{
    		$redirctUrl = $BaseUrl . "/store/my-draft.php";
    	}
    	
		$re->redirect($redirctUrl);
    }
    
    
?>