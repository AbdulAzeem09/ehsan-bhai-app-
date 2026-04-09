<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
function sp_autoloader($class){
  include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$c = new _postfield;
	
if($_POST["editing_"] == "true"){
	$r = $c->readpostfield($_POST["spPostings_idspPostings"]);
	if($r != false){
		while($row = mysqli_fetch_assoc($r)){

			$c->update(array("spPostFieldValue" => $_POST["spPostFieldValue"]), "WHERE spPostFieldLabel = '" . $_POST["spPostFieldLabel"] . "' AND spPostings_idspPostings =". $_POST["spPostings_idspPostings"]);
			
		}
	}
}
else{
	 $c->create($_POST);
}

	
?>
