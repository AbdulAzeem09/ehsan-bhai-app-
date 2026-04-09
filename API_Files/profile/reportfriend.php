<?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


	
	$f = new _spprofilefeature;


$idspProfileBy 	= $_POST['idspProfileBy'];
		$idspProfileTo 	= $_POST['idspProfileTo'];
		$radReport 		= $_POST['radReport'];
	
$reportdata= array( 
	          "idspProfileBy" => $idspProfileBy,
	          "idspProfileTo" => $idspProfileTo,
	          "radReport" => $radReport
	         
              );



	
	

	if($idspProfileBy > 0 && $idspProfileTo > 0){
		//echo "here";

		//print_r($_POST);
		$id = $f->reportSubmit($idspProfileBy, $idspProfileTo, $radReport);
	     // echo $p->tad->sql;

		 $data = array("status" => 200, "message" => "success","data"=>$reportdata);
	}else{

		$data = array("status" => 1, "message" => "Enter profile id");
	}	



echo json_encode($data);

?>