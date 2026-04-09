<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

session_start();

function sp_autoloader($class)
{
   include '../mlayer/' . $class . '.class.php';
}


//  echo "<pre>";
//  print_r($_POST);
// die('+++++++');

$sellType = isset($_POST["sellType"]) ? $_POST["sellType"] : "";


if (isset($_SESSION['ptid']) && $_SESSION['ptid'] == 3) {
  if ($sellType != "Auction" && $sellType != "Personal"){
    die("INVALID sellType");
    exit;
  } 
}

if ($_POST["sellType"] == "Auction") {

   $data = array(
      "sellType" => $_POST["sellType"],
      "spCategories_idspCategory" => $_POST["spCategories_idspCategory"],
      "spPostingVisibility" => $_POST["spPostingVisibility"],
      "spProfiles_idspProfiles" => $_POST["spProfiles_idspProfiles"],
      "spPostingTitle" => $_POST["spPostingTitle"],
      "spPostingExpDt" => $_POST["spPostingExpDt"],
      "spPostingsFlag" => $_POST["spPostingsFlag"],
      "subcategory" => $_POST["subcategory"],
      "quantitytype" => $_POST["quantitytype"],
      "auctionEndDate" => $_POST["spPostingExpDt"],
      "auctionQuantity" => $_POST["auctionQuantity"],
      "auctionStatus" => $_POST["auctionStatus"],
      "spPostingPrice" => $_POST["spPostingPrice"],
      "spPostingNotes" => $_POST["spPostingNotes"],
      "specification" => $_POST["specification"],
      "description" => $_POST["description"],
      "spgroup" => $_POST["group"],
      "spPostingEmail" => $_POST["spPostingEmail"],
      "spPostingPhone" => $_POST["spPostingPhone"],
      "product_type" => $_POST["protype"],
      "sippingcharge" => $_POST["sippingcharge"],
      "fixedamount" => $_POST["fixedamount"],
      "weight_shipping" => $_POST["weight_shipping"],
      "height_shipping" => $_POST["height_shipping"],
      "width_shipping" => $_POST["width_shipping"],
      "depth_shipping" => $_POST["depth_shipping"],
      "barcode" => $_POST["barcode"],
      "default_currency" => $_POST["default_currency"],
      "spuser_idspuser" => $_POST['spuser_idspuser'],
      "featuredImageCrop" => $_POST['featuredImageCrop']
   );
}


if ($_POST["sellType"] == "Retail") {
   $price      = $_POST['spPostingPrice'];
   $discount   = $_POST['retailSpecDiscount'];
   //echo $discount;


   $org_price = ((int)$discount * (int)$price) / 100;



   //echo $dis_price;
   $disc_price = (int)$price - (int)$org_price;

   if ($discount == "" || $discount == '0') {
      $discount = $price;
   }


   $data = array(
      "sellType" => $_POST["sellType"],
      "spCategories_idspCategory" => $_POST["spCategories_idspCategory"],
      "spPostingVisibility" => $_POST["spPostingVisibility"],
      //"spPostingVisibility"=> -1,
      "spProfiles_idspProfiles" => $_POST["spProfiles_idspProfiles"],
      "spPostingTitle" => $_POST["spPostingTitle"],
      "spPostingExpDt" => $_POST["spPostingExpDt"],
      "spPostingsFlag" => $_POST["spPostingsFlag"],
      "subcategory" => $_POST["subcategory"],
      "quantitytype" => $_POST["quantitytype"],
      "retailDiscount" => $_POST["retailDiscount"],
      "retailSpecDiscount" => $discount,
      "retailQuantity" => $_POST["retailQuantity"],
      "retailStatus" => $_POST["retailStatus"],
      "spPostingPrice" => $_POST["spPostingPrice"],
      "spPostingNotes" => $_POST["spPostingNotes"],
      "specification" => $_POST["specification"],
      "description" => $_POST["description"],
      "spgroup" => $_POST["group"],
      "spPostingEmail" => $_POST["spPostingEmail"],
      "spPostingPhone" => $_POST["spPostingPhone"],
      "product_type" => $_POST["protype"],
      "is_cancel" => $_POST["yes_no"],
      "is_refund" => $_POST["yes"],
      "refund_within" => $_POST["refund"],
      "sippingcharge" => $_POST["sippingcharge"],
      "fixedamount" => $_POST["fixedamount"],
      "weight_shipping" => $_POST["weight_shipping"],
      "height_shipping" => $_POST["height_shipping"],
      "width_shipping" => $_POST["width_shipping"],
      "depth_shipping" => $_POST["depth_shipping"],
      "default_currency" => $_POST["default_currency"],
      "barcode" => $_POST["barcode"],
      "discounted_price" => $disc_price,
      "spuser_idspuser" => $_POST['spuser_idspuser'],
      "featuredImageCrop" => $_POST['featuredImageCrop']




   );
}
if ($_POST["sellType"] == "Personal") {
   $price      = $_POST['spPostingPrice'];
   $discount   = $_POST['retailSpecDiscount'];
   //echo $discount;


   $org_price = ((int)$discount * (int)$price) / 100;



   //echo $dis_price;
   $disc_price = (int)$price - (int)$org_price;

   if ($discount == "" || $discount == '0') {
      $discount = $price;
   }


   $data = array(
      "sellType" => $_POST["sellType"],
      "spCategories_idspCategory" => $_POST["spCategories_idspCategory"],
      "spPostingVisibility" => $_POST["spPostingVisibility"],
      //"spPostingVisibility"=> -1,
      "spProfiles_idspProfiles" => $_POST["spProfiles_idspProfiles"],
      "spPostingTitle" => $_POST["spPostingTitle"],
      "spPostingExpDt" => $_POST["spPostingExpDt"],
      "spPostingsFlag" => $_POST["spPostingsFlag"],
      "subcategory" => $_POST["subcategory"],
      "quantitytype" => $_POST["quantitytype"],
      "retailDiscount" => $_POST["retailDiscount"],
      "retailSpecDiscount" => $discount,
      "retailQuantity" => $_POST["retailQuantity"],
      "retailStatus" => $_POST["retailStatus"],
      "spPostingPrice" => $_POST["spPostingPrice"],
      "spPostingNotes" => $_POST["spPostingNotes"],
      "specification" => $_POST["specification"],
      "description" => $_POST["description"],
      "spgroup" => $_POST["group"],
      "spPostingEmail" => $_POST["spPostingEmail"],
      "spPostingPhone" => $_POST["spPostingPhone"],
      "product_type" => $_POST["protype"],
      "is_cancel" => $_POST["yes_no"],
      "is_refund" => $_POST["yes"],
      "refund_within" => $_POST["refund"],
      "sippingcharge" => $_POST["sippingcharge"],
      "fixedamount" => $_POST["fixedamount"],
      "weight_shipping" => $_POST["weight_shipping"],
      "height_shipping" => $_POST["height_shipping"],
      "width_shipping" => $_POST["width_shipping"],
      "depth_shipping" => $_POST["depth_shipping"],
      "default_currency" => $_POST["default_currency"],
      //"barcode" => $_POST["barcode"],
      "discounted_price" => $disc_price,
      "spuser_idspuser" => $_POST['spuser_idspuser'],
      "featuredImageCrop" => $_POST['featuredImageCrop']




   );
}
if ($_POST["sellType"] == "Wholesale") {
  
   $data = array(

      "sellType" => $_POST["sellType"],
      "spCategories_idspCategory" => $_POST["spCategories_idspCategory"],
      "spPostingVisibility" => $_POST["spPostingVisibility"],
      "spProfiles_idspProfiles" => $_POST["spProfiles_idspProfiles"],
      "spPostingTitle" => $_POST["spPostingTitle"],
      "spPostingExpDt" => $_POST["spPostingExpDt"],
      "spPostingsFlag" => $_POST["spPostingsFlag"],
      "subcategory" => $_POST["subcategory"],
      "quantitytype" => $_POST["quantitytype"],
      "industryType" => $_POST["industryType"],
      "minorderqty" => $_POST["minorderqty"],
      "supplyability" => $_POST["supplyability"],
      "paymentterm" => $_POST["paymentterm"],
      "spPostingPrice" => $_POST["spPostingPrice"],
      "spPostingNotes" => $_POST["spPostingNotes"],
      "specification" => $_POST["specification"],
      "description" => $_POST["description"],
      "spgroup" => $_POST["group"],
      "spPostingEmail" => $_POST["spPostingEmail"],
      "spPostingPhone" => $_POST["spPostingPhone"],
      "product_type" => $_POST["protype"],
      "sippingcharge" => $_POST["sippingcharge"],
      "fixedamount" => $_POST["fixedamount"],
      "weight_shipping" => $_POST["weight_shipping"],
      "height_shipping" => $_POST["height_shipping"],
      "width_shipping" => $_POST["width_shipping"],
      "depth_shipping" => $_POST["depth_shipping"],
      "default_currency" => $_POST["default_currency"],
      "barcode" => $_POST["barcode"],
      "spuser_idspuser" => $_POST['spuser_idspuser'],
      "wholesaleQuantity" => $_POST['wholesaleQuantity'],
      "featuredImageCrop" => $_POST['featuredImageCrop']
   );
   
}


//print_r($data);

spl_autoload_register("sp_autoloader");
//echo"here";
$p = new _productposting;
$ponv = new _spproductoptionsvalues;

//_spproductsize
 $spid = isset($_POST["spuser_idspuser"]) ? (int) $_POST["spuser_idspuser"] : 0;
 
if (isset($_POST["idspPostings"]) && $_POST["idspPostings"] != '' && $_POST["idspPostings"] != 0) {
    // echo"here";
   //print_r($data);
     $postid = isset($_POST["idspPostings"]) ? (int) $_POST["idspPostings"] : 0;
     $profileid = isset($_POST["spProfiles_idspProfiles"]) ? (int) $_POST["spProfiles_idspProfiles"] : 0;
     if($_SESSION['uid']==$spid && $_SESSION['pid'] == $profileid){
     $userdata = $p->readdata($postid,$_SESSION['pid']);
     if($userdata){
      $postid = $p->update($data, " WHERE t.idspPostings=" . $postid);
     
   /*echo $p->ta->sql;*/
   $resultdata = $ponv->delepro_attrib($postid, 'Store', $_SESSION['uid'], $_SESSION['pid']);

   if (isset($_POST['newcolorids'])) {
      $coloropvalearr = $_POST['newcolorids'];
      if (count($coloropvalearr) > 0 && is_array($coloropvalearr)) {
         for ($i = 0; $i < count($coloropvalearr); $i++) {
            $coloroptvalid = $coloropvalearr[$i];
            $sizeoptvalueid = $_POST['newsizeids'][$i];
            $optprice = $_POST['pricenew'][$i];
            $optqty = $_POST['qtynew'][$i];

            $attribdata = array(
               "item_id" => $postid,
               "color_idsopv" => $coloroptvalid,
               "color_idsop" => "1",
               "size_idsopv" => $sizeoptvalueid,
               "size_idsop" => "2",
               "opt_qty" => $optqty,
               "opt_price" => $optprice,
               "opt_price_prefix" => "+",
               "spByuerProfileId" => $_SESSION['pid'],
               "spBuyeruserId" => $_SESSION['uid'],
               "item_type" => "Store"
            );

            $ponv->create_atrib($attribdata);
         }
      }
   }
  }
  else{
    echo "Invalid request";
    exit;
  }
  }else{
    echo "user not found";
    exit;
  }
   echo trim($_POST["idspPostings"]);
   
} else {
   //die('============================================');
   $profileid = isset($_POST["spProfiles_idspProfiles"]) ? (int) $_POST["spProfiles_idspProfiles"] : 0;
   if($_SESSION['uid']== $spid){
   $userdata = $p->readuser($profileid,$_SESSION['uid']);
   if($userdata){
     $postid = $p->create($data);
    //echo $p->ta->sql; die("------");  
    /*echo $mysqli->info;
     echo $postid;*/
  } else{
    echo "request is invalid";
    exit;
  }
  } else{
    echo "user not exist";
    exit;
  }
   echo trim($postid);

   if (isset($_POST['newcolorids'])) {
      $coloropvalearr = $_POST['newcolorids'];
      if (count($coloropvalearr) > 0 && is_array($coloropvalearr)) {
         for ($i = 0; $i < count($coloropvalearr); $i++) {
            $coloroptvalid = $coloropvalearr[$i];
            $sizeoptvalueid = $_POST['newsizeids'][$i];
            $optprice = $_POST['pricenew'][$i];
            $optqty = $_POST['qtynew'][$i];

            $attribdata = array(
               "item_id" => $postid,
               "color_idsopv" => $coloroptvalid,
               "color_idsop" => "1",
               "size_idsopv" => $sizeoptvalueid,
               "size_idsop" => "2",
               "opt_qty" => $optqty,
               "opt_price" => $optprice,
               "opt_price_prefix" => "+",
               "spByuerProfileId" => $_SESSION['pid'],
               "spBuyeruserId" => $_SESSION['uid'],
               "item_type" => "Store"
            );

            $ponv->create_atrib($attribdata);
         }
      }
   }
}
