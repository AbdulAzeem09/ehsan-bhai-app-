<?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


$c = new _spchat;
	$from 		= $_POST['spprofiles_idspProfilesSender'];
	$to 		= $_POST['spprofiles_idspProfilesReciver'];
	$message 	= $_POST['message'];


$chatdata = array( 
	          "spprofiles_idspProfilesSender" => $from,
	          "spprofiles_idspProfilesReciver" => $to,
	          "spfriendChattingMessage" => $message

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
	
	

	if(!empty($_POST['spprofiles_idspProfilesSender'])){
		//echo "here";

		//print_r($_POST);
		$id = $c->create($chatdata);
$chatdatamessage = array( 
	          "idspfriendChatting" => $id,
	          "spprofiles_idspProfilesSender" => $from,
	          "spprofiles_idspProfilesReciver" => $to,
	          "spfriendChattingMessage" => $message

              );
		
	     // echo $p->tad->sql;

		 $data = array("status" => 200, "message" => "success","data"=>$chatdatamessage);
	}else{

		$data = array("status" => 1, "message" => "Enter Profile id");
	}	



echo json_encode($data);

?>