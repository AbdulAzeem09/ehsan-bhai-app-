<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$pf = new _postfield;
	
	//echo $_POST['multi'];
	//echo $c->ta->sql;
	$spPostFieldLabel = "Cohost";
	$spPostFieldName = "spPostingCohost_";
	$spPostings_idspPostings = $_POST['postid'];
	$spCategories_idspCategory = 9;
	$postid = $_POST['postid'];

	$allCohost = array();
	$allCohost = explode( ',', $_POST['cohost']);
	//print_r($allsize);
	if($_POST["postedit"] == "true"){
		$pf->removeSponsor($postid, $spPostFieldLabel);
		if(count($allCohost) > 0){
			foreach ($allCohost as $key => $value) {
				$spPostFieldValue = $value;
				$pf->createSize($spPostFieldLabel, $spPostFieldName, $spPostings_idspPostings, $spCategories_idspCategory, $value);
			}
		}
	}else{
		if(count($allCohost) > 0){
			foreach ($allCohost as $key => $value) {
				$spPostFieldValue = $value;
				$pf->createSize($spPostFieldLabel, $spPostFieldName, $spPostings_idspPostings, $spCategories_idspCategory, $value);
			}
		}
	}
	
?>
