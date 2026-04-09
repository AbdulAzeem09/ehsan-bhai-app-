<?php

	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");





   $p = new _orderSuccess;
    $or = new _order;


/*echo "hee";
 print_r($_POST);*/

    $ship_cmpny = $_POST['ship_cmpny'];
    $shipTrack = $_POST['shipTrack'];
    $shipDate = $_POST['shipDate'];
    $idspOrder  = $_POST['idspOrder'];

    // ===CREATE SHIPING INFO
    if(!empty($idspOrder)){
   $result = $p->createShip($ship_cmpny, $shipTrack, $shipDate);
   // echo $p->sh->sql;
     if ($result) {
        // ===UPDATE SHIP CART
        $res = $or->updateShip($idspOrder, $result);
    }

    $adddata = array("ship_cmpny"=>$ship_cmpny,"shipTrack"=>$shipTrack,"shipDate"=>$shipDate,"idspOrder"=>$idspOrder);

		 $data = array("status" => 200, "message" => "success","data"=>$adddata);
	}else{

		$data = array("status" => 1, "message" => "No Order found");
	}	



echo json_encode($data);

?>