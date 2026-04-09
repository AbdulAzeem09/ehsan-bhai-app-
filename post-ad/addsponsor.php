<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$pf = new _postfield;
	
	//echo $_POST['multi'];
	//echo $c->ta->sql;
	$spPostFieldLabel = "Sponsor";
	$spPostFieldName = "sponsorId_";
	$spPostings_idspPostings = $_POST['postid'];
	$spCategories_idspCategory = 9;
	$postid = $_POST['postid'];

	$allSponsor = array();
	$allSponsor = explode( ',', $_POST['spon']);
	//print_r($allsize);
	if($_POST["postedit"] == "true"){
		
		
		$pf->removeSponsor($postid, $spPostFieldLabel);
		if(count($allSponsor) > 0){
			foreach ($allSponsor as $key => $value) {
				$spPostFieldValue = $value;
				$pf->createSize($spPostFieldLabel, $spPostFieldName, $spPostings_idspPostings, $spCategories_idspCategory, $value);
			}
		}

	}else{
		if(count($allSponsor) > 0){
			foreach ($allSponsor as $key => $value) {
				$spPostFieldValue = $value;
				$pf->createSize($spPostFieldLabel, $spPostFieldName, $spPostings_idspPostings, $spCategories_idspCategory, $value);
			}
		}
	}
	
?>
