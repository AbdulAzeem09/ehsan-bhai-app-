<?php

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _groupeventpic;
	
	
	$img = $_POST["spPostingPic"];

	$img = str_replace("data:image/".$_POST["ext"].";base64,", "", $img);
	$img = str_replace(" ", "+", $img);
	$data = base64_decode($img);

	if(isset($_POST['spFeatureimg'])){
		$FeatureImg = $_POST['spFeatureimg'];
	}else{
		$FeatureImg = 0;
	}

	//echo $_POST['postedit']. '--'.$_POST['del'];

	if(isset($_POST['postedit']) && $_POST['postedit'] == true){
		if (isset($_POST['del'])) {
			if($_POST['del'] == 0){
				$postid = $_POST['spPostings_idspPostings'];
				$result = $p->removePostPic($postid);
			}
		}

		/*print_r($_POST["spPostings_idspPostings"]);
        print_r($data);
        print_r($FeatureImg);*/
		//$p->create($_POST["spPostings_idspPostings"], $data);
		$p->createPic($_POST["spPostings_idspPostings"], $data, $FeatureImg);
		//echo $p->ta->sql;
		echo $_POST["spPostings_idspPostings"];
		

	}else{
		//$p->create($_POST["spPostings_idspPostings"], $data);
		//print_r($_POST["spPostings_idspPostings"]);
        /*print_r($data);
        print_r($FeatureImg);*/


		$p->createPic($_POST["spPostings_idspPostings"], $data, $FeatureImg);
		//echo $p->ta->sql;
		echo $_POST["spPostings_idspPostings"];
	}
	
	
	
?>