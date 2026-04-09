

    <?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");






    $p = new _order;
    $result = $p->readSellerOrder($_POST['profile_id']);
	//echo $po->ta->sql;
	
	if($result != false){
	    while($row = mysqli_fetch_assoc($result)){ 
              

      //print_r($row);
$dt = new DateTime($row['sporderdate']);

		$orderdata[] = array("idspOrder"=>$row['idspOrder'],"spByuerProfileId"=>$row['spByuerProfileId'],"spBuyeruserId"=>$row['spBuyeruserId'],"spSellerProfileId"=>$row['spSellerProfileId'],"spOrderStatus"=>$row['spOrderStatus'],"spOrderQty"=>$row['spOrderQty'],"sporderAmount"=>$row['sporderAmount'],"sporderdate"=>$row['sporderdate'],"txn_id"=>$row['txn_id'],"spPostings_idspPostings"=>$row['spPostings_idspPostings'],"spPostingTitle"=>$row['spPostingTitle'],'idspShip'=>$row['idspShip']);


       }

		 $data = array("status" => 200, "message" => "success","data"=>$orderdata);
	}else{

		$data = array("status" => 1, "message" => "No Order found");
	}	



echo json_encode($data);

?>