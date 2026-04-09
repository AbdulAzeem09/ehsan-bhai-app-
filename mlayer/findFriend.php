<?php
	session_start();
	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$p = new _spprofiles;
	if(!isset($_GET['searchTerm'])){ 
        $json = [];
    }else{
    	$search = $_GET['searchTerm'];
    	$json=$p->friendNamelist($_GET["searchTerm"],$_SESSION["uid"],$_SESSION["pid"]);
    	
    }
	//echo "<pre>";
	//print_r($json); die;
echo json_encode($json);