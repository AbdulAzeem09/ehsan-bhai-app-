<?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


 //print_r($_POST);
	$p = new _timelineflag;

$flagdata= array( 


'spPosting_idspPosting' => $_POST['spPosting_idspPosting'],
'why_flag'=>  $_POST['why_flag'],
'spProfile_idspProfile'=>  $_POST['spProfile_idspProfile'],
'flagpostprofileid'=>  $_POST['flagpostprofileid'],
'userid' => $_POST['userid'],
'flagpostuserid' = $_POST['flagpostuserid'],
'flag_date'  => $_POST['flag_date']
              );

/*Array
(
    [spPostings_idspPostings] => 30
    [spProfiles_idspProfiles] => 510
    [auctionPrice] => 45
    [lastBid] => 42
)
 */
/* [spOrderAdid_] => 40
    [spByuerProfileId] => 521
    [spBuyeruserId] => 384
    [size] => 
    [sporderAmount] => 123
    [spSellerProfileId] => 510
    [spOrderQty] => 1
	print_r($_POST);*/
	//$result = $p-> priviousorder($_POST["spOrderAdid_"],$_POST["spByuerProfileId"]);
	
	

	if(!empty($_POST['spPosting_idspPosting'])){
		//echo "here";

		//print_r($_POST);
		$id = $p->create($flagdata);
	     // echo $p->tad->sql;

		 $data = array("status" => 200, "message" => "success","data"=>$flagdata);
	}else{

		$data = array("status" => 1, "message" => "Enter post id");
	}	



echo json_encode($data);

?>