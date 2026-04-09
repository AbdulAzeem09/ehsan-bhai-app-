<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$cn = new _direcctory_gallery;
	$result = $cn->reaadGallery($_GET['gallery']);
	if($result){
		$row = mysqli_fetch_assoc($result);
		unlink('../upload/directory-gallery/'.$row['gallery_img']);
		$cn->removeGallery($_GET["gallery"]);
	}


	
	//echo $m->ta->sql;
	$re = new _redirect;
    $redirctUrl = "../business-directory/gallery.php";
    $re->redirect($redirctUrl);
	//header('location:news.php');
?>