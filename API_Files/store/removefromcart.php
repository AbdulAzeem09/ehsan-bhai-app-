<?php
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

	$rfc = new _order;
	

	if (isset($_POST['orderid']) && $_POST['orderid'] > 0) {
		// remove from cart
		$rfc->removefromCart($_POST["orderid"]);

		$data = array("status" => 200, "message" => "success");
	}else{

		$data = array("status" => 1, "message" => "Please Enter orderid");
	}
	

echo json_encode($data);

?>