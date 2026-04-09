<?php

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _exhibition;
	
    // Convert to base64 
    $image_base64 = $_POST['spExhibitionImage'];
    $spExhibitionTitle = $_POST['spExhibitionTitle'];
    $spStartDate = $_POST['spStartDate'];
    $spEndDate = $_POST['spEndDate'];
    $spExhibitionVenu = $_POST['spExhibitionVenu'];
    $spExhibitionDesc		= $_POST['spExhibitionDesc'];
    $spProfile_idspProfile 	= $_POST['spProfile_idspProfile'];

    $id = $p->create($spExhibitionTitle,$image_base64, $spStartDate, $spEndDate, $spExhibitionVenu, $spExhibitionDesc, $spProfile_idspProfile);		
    echo $id;
    
?>