<?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


$p = new _rfq;
  function uploadPagePic($inputName, $uploadDir,$newW, $newH){
        $image     = $_FILES[$inputName];
        $imagePath = '';
        $thumbnailPath = '';
        $imgSize = getimagesize($image['tmp_name']);
        // if a file is given
        if (trim($image['tmp_name']) != '') {
            $ext = substr(strrchr($image['name'], "."), 1); //$extensions[$image['type']];
            // generate a random new file name to avoid name conflict
            $imagePath = md5(rand() * time()) . ".$ext";
            list($width, $height, $type, $attr) = getimagesize($image['tmp_name']); 
            // make sure the image width does not exceed the
            // maximum allowed width
            if ($width > $newW) {
                $result  = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, $newW, $newH);
                $imagePath = $result;
            } else {
                $result = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);
            }
            // make sure the image height does not exceed the
            // maximum allowed height
            
            if ($height > $newH) {
                $result  = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, $newW, $newH);
                $imagePath = $result;
            } else {
                $result = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);
            }
        }
        //return array('image' => $imagePath, 'thumbnail' => $thumbnailPath);
        return $imagePath;
    }



    $rfqTitle = $_POST['rfqTitle'];
    $rfqCategory = $_POST['rfqCategory'];
    $rfqQty = $_POST['rfqQty'];
    $rfqDelivered = $_POST['rfqDelivered'];
    $rfqCountry = $_POST['rfqCountry'];
    $rfqState = $_POST['spQuotationState'];
    $rfqCity = $_POST['spQuotationCity'];
    $rfqDesc = $_POST['rfqDesc'];
    $rfqquote = $_POST['spQuotereached'];
    
    $pid = $_POST['profileid'];
   $catid = 1;

    $timestamp = time();

     $datetime  = date("F d, Y h:i:s", $timestamp);

   // echo $rfqState;
   // echo $rfqCity;

    $rfqImg  = $_FILES['spPostingMedia']['tmp_name'];
    if ($rfqImg != '') {
        $rfq_img =   uploadPagePic('spPostingMedia' , "../../upload/store/rfq/", true, true);
    }else {
        $rfq_img = '';
    }



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
	
	

	if(!empty($_POST['profileid'])){
		//echo "here";

		//print_r($_POST);
		   $result = $p->createRfq($rfqTitle, $rfqCategory, $rfqQty, $rfqDelivered, $rfqCountry, $rfqState, $rfqCity, $rfqDesc, $pid, $catid, $rfqquote, $rfq_img, $datetime);
  $rfqTitle = $_POST['rfqTitle'];
    $rfqCategory = $_POST['rfqCategory'];
    $rfqQty = $_POST['rfqQty'];
    $rfqDelivered = $_POST['rfqDelivered'];
    $rfqCountry = $_POST['rfqCountry'];
    $rfqState = $_POST['spQuotationState'];
    $rfqCity = $_POST['spQuotationCity'];
    $rfqDesc = $_POST['rfqDesc'];
    $rfqquote = $_POST['spQuotereached'];
    
    $pid = $_POST['profileid'];
    $rfq_data = array('rfqTitle' => $_POST['rfqTitle'],'rfqCategory' => $_POST['rfqCategory'],'rfqQty' => $_POST['rfqQty'],'rfqDelivered' => $_POST['rfqDelivered'],'rfqCountry' => $_POST['rfqCountry'],'spQuotationState' => $_POST['spQuotationState'],'spQuotationCity' => $_POST['spQuotationCity'],'rfqDesc' => $_POST['rfqDesc'],'spQuotereached' => $_POST['spQuotereached'],'profileid' => $_POST['profileid'] );
	     // echo $p->tad->sql;

		 $data = array("status" => 200, "message" => "success","data"=>$rfq_data);
	}else{

		$data = array("status" => 1, "message" => "Enter Profile id");
	}	



echo json_encode($data);

?>