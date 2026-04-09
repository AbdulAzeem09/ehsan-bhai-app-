

    <?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");






    $p = new _order;
    $result = $p->readSellerOrderStatus($_POST['profile_id'],2);
	//echo $po->ta->sql;
	
	if($result != false){
	    while($row = mysqli_fetch_assoc($result)){ 
              
 $dt = new DateTime($row['ship_date']);
      // print_r($row);


		$orderdata[] = array("idspOrder"=>$row['idspOrder'],"spByuerProfileId"=>$row['spByuerProfileId'],"ship_track_id"=>$row['ship_track_id'],"ship_cmpny"=>$row['ship_cmpny'],"spOrderStatus"=>$row['spOrderStatus'],"spOrderQty"=>$row['spOrderQty'],"sporderAmount"=>$row['sporderAmount'],"sporderdate"=>$dt->format('d-M-Y'),"txn_id"=>$row['txn_id'],"spPostings_idspPostings"=>$row['spPostings_idspPostings'],"spPostingTitle"=>$row['spPostingTitle'],'idspShip'=>$row['idspShip']);


       }

		 $data = array("status" => 200, "message" => "success","data"=>$orderdata);
	}else{

		$data = array("status" => 1, "message" => "No Order found");
	}	



echo json_encode($data);

?>