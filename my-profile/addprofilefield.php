<?php

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$c = new _profilefield;
	if($_POST["editing_"] == "true"){
		if($_POST['spProfileFieldValue'] != '') {
			$result = $c->readField($_POST['spprofiles_idspProfiles'], $_POST['spProfileFieldName']);
			if($result){
				$res = $c->read($_POST["spprofiles_idspProfiles"]);
				if($res != false) {
					while($row = mysqli_fetch_assoc($res)) {
						$c->update(array("spProfileFieldValue" => $_POST["spProfileFieldValue"]), "WHERE spProfileFieldName = '" . $_POST["spProfileFieldName"] . "' AND spprofiles_idspProfiles =". $_POST["spprofiles_idspProfiles"]);
					}
				}
			} else {
				$c->create($_POST);
			}
		}
	}else{
		$c->create($_POST);
	}
?>
