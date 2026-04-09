<?php

//echo "<pre>";

//print_r($_POST); die('===========');   
		/*error_reporting(E_ALL);
	ini_set('display_errors', '1');*/
    include('../univ/baseurl.php');
	//include('../univ/baseurl.php');
	include( "../univ/main.php");
    session_start();
	
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	
					
	$spOrderadid = isset($_POST['spOrderAdid_']) ? (int) $_POST['spOrderAdid_'] : 0;							
	$p = new _spcustomers_basket;
	$auc = new _spauctionbid;
	$ponv = new _spproductoptionsvalues;
	//echo "<pre>";
	//print_r($_POST);
	//exit;	
//	die('=====');
	if(isset($_POST['placebidAuction1'])){ 
	//die('====--');
		
		$aucPrice = $_POST['auctionPrice1'];
		$spProfiles_idspProfiles = $_POST['spProfiles_idspProfiles'];
		$lastBid = $_POST['lastBid'];
		$spPostings_idspPostings = $_POST['spPostings_idspPostings'];
		$curdate = $_POST['curdate'];
		$austatus = $_POST['austatus'];
		
		$data = array(
		"spPostings_idspPostings" => $spPostings_idspPostings,
		"spProfiles_idspProfiles" => $spProfiles_idspProfiles,
		"auctionPrice" => $aucPrice,
		"lastBid" => $lastBid,
		"status" => $austatus,
		"bid_timestamp" => $curdate
		);
		
	//	$checking = $auc->ReadBid($spPostings_idspPostings,$spProfiles_idspProfiles);
		
		
		//$check = mysqli_num_rows($checking);
		
	/*	if($checking->num_rows > 0){
	//		die("111111");
			$auc->updatebid($data,$spPostings_idspPostings);

			$redirctUrl = $_SERVER['HTTP_REFERER'];
			$re = new _redirect;
			$re->redirect($redirctUrl);
			
			}else{*/
		//				die("22222222");
		if(!empty($_POST['auctionPrice1'])){
			$auc->create($data);
		}
			
			$redirctUrl = $_SERVER['HTTP_REFERER'];
			$re = new _redirect;
			$re->redirect($redirctUrl);
		//}
	}
	
	
	
	
	//$_POST['idspPostings'] = $_POST['spOrderAdid_'];
	
	
	$result = $p->priviousorder($_POST["idspPostings"],$_POST["spByuerProfileId"],$_POST['cartItemType']);
	//print_r($result);
	if($result !=""){
		$rowcount=$result->num_rows;
	}
	
	//die('--');
	else{
		$rowcount='';
		
	}
 	if($rowcount != ""){
		
		$rowdata = mysqli_fetch_assoc($result);
		
		$totalqty = ($rowdata['spOrderQty']+$_POST['spOrderQty']);
		
		
		$p->updateqtyByitemid($_POST["idspPostings"] , $totalqty, $_POST["spByuerProfileId"], $_POST['cartItemType']);
		
		//echo $p->ta->sql;
		//exit;
		
		$_SESSION['successMessage']= "Successfully Added to Cart";
		
	} 
	
	else{
		
		if(isset($_POST['colorid'])){
			$colorid = $_POST['colorid'];
			
		}
		else{
			$colorid = 0;
			
			}if(isset($_POST['sizeid'])){
			$sizeids = $_POST['sizeid'];
			
		}
		else{
			$sizeids = 0;
			
		}
		
		if($colorid!="0" && $sizeids!="0")
		{
			$valuedata = $ponv->readattribprice($spOrderadid,'Store',$sizeids,$colorid);
			//print_r($valuedata);
			$vdata = mysqli_fetch_assoc($valuedata);
			
			$amount = $vdata['opt_price'];
		}
		else
		{
	//die('====');
			$amount = $_POST['sporderAmount'];
		}
		$addDate = date("Y-m-d H:i:s");     
		
		$postdata = array("idspPostings" => $spOrderadid,
		"spOrderQty" =>$_POST['spOrderQty'],
		"spByuerProfileId" =>$_POST['spByuerProfileId'],
		"spBuyeruserId"=>$_POST['spBuyeruserId'],
		"sporderAmount"=>$amount,
		"sporderdate"=>$addDate,
		"spSellerProfileId"=>$_POST['spSellerProfileId'],
		"cartItemType"=>$_POST['cartItemType'],
		'shipping_address'=>$shpping_Address
		);
		if(isset($_POST['addtocart'])){
		//die('99999999999');
		$p1=$p->readitem($spOrderadid,$_SESSION['pid']);
		if($p1==false){
		$id = $p->create($postdata);
		header("Location: $BaseUrl/cart/");
		}
		else{
		//die('======');
		header("Location: $BaseUrl/store/detail.php?postid=".$spOrderadid);
		
		}
		}
		
		if(isset($_POST['buy_now'])){
		//die('99999999999');
		$p1=$p->readitem($spOrderadid,$_SESSION['pid']);
		if($p1==false){
		$id = $p->create($postdata);
		header("Location: $BaseUrl/cart/");
		}
		else{
		//die('======');
		header("Location: $BaseUrl/store/detail.php?postid=".$spOrderadid);
		
		}
		}
		
		if($colorid!="" && $sizeids!="")
		{
			
			
			$addDate = date("Y-m-d H:i:s"); 
			
			$postattribdata = array("idspOrder" => $id,
			"idspPostings" => $spOrderadid,
			"spByuerProfileId" =>$_POST['spByuerProfileId'],
			"spBuyeruserId"=>$_POST['spBuyeruserId'],
			"spSellerProfileId"=>$_POST['spSellerProfileId'],
			"color_idsopv"=>$colorid,
			"size_idsopv"=>$sizeids,
			"cartItemType"=>$_POST['cartItemType']
			);
			$id = $p->create_attrib($postattribdata);
			
			
		}
		
		
	    $_SESSION['successMessage'] ="Successfully Added to Cart";
	}	
	/*if(isset($_POST['buy_now'])){
		die();?>
		
		<script>
		
		window.location.href = " /cart/index.php "; 
		
		</script>
		
	<?php }*/
	//die("------------");
	// IN EVENT SHOW THIS ONE. WHY IS SHOW IN EVENT CHEK IT NOW AND MAKE IT AJAX OR JQUERY
	//$redirctUrl = $BaseUrl . "/events/";
	$redirctUrl = $_SERVER['HTTP_REFERER'];
	$re = new _redirect;
	$re->redirect($redirctUrl);
?>
