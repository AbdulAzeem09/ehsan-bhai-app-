<?php

	function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _sponsorpic;
	if(isset($_POST["idspSponsor"]) && $_POST['idspSponsor'] > 0){
		$idspSponsor = $_POST['idspSponsor'];
		$id = $p->updateSponsor($_POST, "WHERE t.idspSponsor =" . $_POST["idspSponsor"]);
		echo $idspSponsor;
	}else{
		$id = $p->createsp($_POST);	
		echo $id;
	}
	
	
?>