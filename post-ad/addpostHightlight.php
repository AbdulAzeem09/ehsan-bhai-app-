<?php
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$pf = new _postfield;
	
	$spPostFieldLabel = "high lights";
	$spPostFieldName = "spPostHighLit_";
	$spPostings_idspPostings = $_POST['postid'];
	$spCategories_idspCategory = 3;
	$postid = $_POST['postid'];

	$allHighlight = array();
	$allHighlight = explode( ',', $_POST['Highlights']);

	if($_POST["postedit"] == "true"){		
		$pf->removeSponsor($postid, $spPostFieldLabel);
		if(count($allHighlight) > 0){
			foreach ($allHighlight as $key => $value) {
				$spPostFieldValue = $value;
				$pf->createSize($spPostFieldLabel, $spPostFieldName, $spPostings_idspPostings, $spCategories_idspCategory, $value);
			}
		}

	}else{
		if(count($allHighlight) > 0){
			foreach ($allHighlight as $key => $value) {
				$spPostFieldValue = $value;
				$pf->createSize($spPostFieldLabel, $spPostFieldName, $spPostings_idspPostings, $spCategories_idspCategory, $value);
			}
		}
	}
	
?>
