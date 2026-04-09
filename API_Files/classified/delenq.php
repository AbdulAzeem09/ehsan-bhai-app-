<?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


	$p = new _addServiceEnq;
 
if (isset($_POST['enqid']) && $_POST['enqid'] > 0) {
       $enqid = $_POST['enqid'];
       $p->delEnq($enqid);

      $data = array("status" => 200, "message" => "success");
		
	}else{

		$data = array("status" => 1, "message" => "Post Not Found");
	}
	
echo json_encode($data);

?>