<?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


    $rfc = new _order;


	if (isset($_POST['orderId']) && $_POST['orderId'] > 0) {
		// remove from cart
		$rfc->updatesaveforletter($_POST["orderId"],$_POST["savestatus"]);

		$data = array("status" => 200, "message" => "success");
	}else{

			$data = array("status" => 1, "message" => "Please Fill All Fields");
	
	}

echo json_encode($data);

?>