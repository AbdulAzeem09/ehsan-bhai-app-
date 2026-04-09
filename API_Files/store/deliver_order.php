<?php

	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");




 $p = new _orderSuccess;
    $or = new _order;
    $re = new _redirect;
$oid = $_POST['idspOrder'];
    // ===CREATE SHIPING INFO
    if(!empty($oid)){
        $status = 3;
        $or->updateshipstatus($oid, $status);

    $adddata = array("idspOrder"=>$oid);

		 $data = array("status" => 200, "message" => "success","data"=>$adddata);
	}else{

		$data = array("status" => 1, "message" => "No Order found");
	}	



echo json_encode($data);

?>