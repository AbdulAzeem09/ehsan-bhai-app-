<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$cn = new _spprofiles;

	if(isset($_GET['imgid'])){

		$newid = $_GET["newsid"];
    $cn->delete_menu_img($_GET["imgid"]);    

    $re = new _redirect;
    $redirctUrl = "../business-directory/edit_menu.php?id=$newid";       
    $re->redirect($redirctUrl);

	}
	elseif(isset($_GET['image_id'])){  
		
		$newid = $_GET["menu_id"];
	
		$cn->delete_image1($_GET["image_id"]);    
	
		$re = new _redirect;
		$redirctUrl = "../business-directory/edit_menu.php?id=$newid";       
		$re->redirect($redirctUrl);
	
	
	}
	
	
	
	else{
	$cn->delete_menu($_GET["newsid"]);  
	 
	//echo $m->ta->sql;
	$re = new _redirect;
    $redirctUrl = "../business-directory/create_new_menu.php";  
    $re->redirect($redirctUrl);
	//header('location:news.php');
}
    

?>