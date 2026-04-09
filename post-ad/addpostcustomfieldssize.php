<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$pf = new _postfield;
	
	//echo $_POST['multi'];
	//echo $c->ta->sql;
	$spPostFieldLabel = "Media Size";
	$spPostFieldName = "imagesize_";
	$spPostings_idspPostings = $_POST['postid'];
	$spCategories_idspCategory = 13;
	$postid = $_POST['postid'];

$pf->removeafterinsert($postid);

	$allsize = array();
	$allsize = explode( ',', $_POST['multi']);
	//print_r($allsize);
	if(count($allsize) > 0){
		foreach ($allsize as $key => $value) {
			$spPostFieldValue = $value;
			$pf->createSize($spPostFieldLabel, $spPostFieldName, $spPostings_idspPostings, $spCategories_idspCategory, $value);
		}
	}
?>
