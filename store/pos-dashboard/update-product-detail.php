<?php 


//error_reporting(E_ALL);
//ini_set('display_errors', 1);

 include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 
	require_once('../../helpers/image.php');

	
	
	$p = new _spprofiles;  
//$res = $u->read($_SESSION["uid"]);

$id = $_POST['id'];
$hidden_file = $_POST['hidden_file'];  
$itemNo_in = $_POST['itemNo_in'];
$date_in = $_POST['date_in'];
//$gst_in = $_POST['gst_in'];
//$pst_in = $_POST['pst_in'];
$productname_in = $_POST['productname_in'];
$attributes_in = $_POST['attributes_in'];    
$atValue_in = $_POST['atValue_in'];
$product_cat_in = $_POST['product_cat_in'];
$product_sub_cat_in = $_POST['product_sub_cat_in'];  
$product_type_in = $_POST['product_type_in'];
$status_in = $_POST['status_in'];
$s_description_in = $_POST['s_description_in'];
$l_description_in = $_POST['l_description_in'];
$purchase_cost_in = $_POST['purchase_cost_in'];
//$markup_in = $_POST['markup_in'];
//$sellingPrice_in = $_POST['sellingPrice_in'];
//$grossprofit_in = $_POST['grossprofit_in']; 
//$discountable_in = $_POST['discountable_in']; 
$funcationQty_in = $_POST['funcationQty_in']; 
$pirce_in = $_POST['pirce_in'];
$vendor_in = $_POST['vendor_in'];
//$name_in = $_POST['name_in'];
//$cost_in = $_POST['cost_in'];
//$minReorder_in = $_POST['minReorder_in'];
//$lastReceiveCost_in = $_POST['lastReceiveCost_in'];
//$lastReceiveDate_in = $_POST['lastReceiveDate_in'];
$retailQuantity = $_POST['retailQuantity'];
$barcode_in = $_POST['barcode_in'];
$warehouse = $_POST['warehouse'];
$notes_in = $_POST['notes_in'];
$selltype = "Retail";
$spPostingVisibility = "-1";

$data = array(
			    "spPostingTitle"=>$productname_in,
			   "spPostingNotes"=>$notes_in,
			   "barcode"=>$barcode_in,
			   "spPostingDate"=>$date_in,
			   ////"spPostingExpDt"=>$lastReceiveDate_in,
			   "spPostingPrice"=>$purchase_cost_in,
			   //"retailDiscount"=>$discountable_in,
			   "Status"=>$status_in,
			   "sellType"=>$selltype,
			   //"minorderqty"=>$minReorder_in,
			   "product_type"=>$product_type_in,
			   "itemNo_in"=>$itemNo_in,
			  // "gst_in"=>$gst_in,
			   //"pst_in"=>$pst_in,
			   "attributes_in"=>$attributes_in,
			   "atValue_in"=>$atValue_in,
			   "subcategory"=>$product_cat_in,
			   "product_sub_cat_in"=>$product_sub_cat_in,
			   "s_description_in"=>$s_description_in,
			   "l_description_in"=>$l_description_in,
			   //"markup_in"=>$markup_in,
			  // "sellingPrice_in"=>$sellingPrice_in,
			   //"grossprofit_in"=>$grossprofit_in,
			   "funcationQty_in"=>$funcationQty_in,
			   "pirce_in"=>$pirce_in,
			   "vendor_in"=>$vendor_in,
			   //"name_in"=>$name_in,
			   "warehouse_id"=>$warehouse,
			   //"cost_in"=>$cost_in,
			   //"lastReceiveCost_in"=>$lastReceiveCost_in,
			   "spPostingVisibility"=>$spPostingVisibility, 
			   "retailQuantity"=>$retailQuantity, 
			
); 

$res = $p->update_mem_qty_product($data,$id);      


$pf = new _productpic;
if($_FILES['productimage']){ 
  $image = new Image();
  $image->validateFileImageExtensions($_FILES['productimage']);
  
$target_path = "upload_pos/"; 
 
$target_path = $target_path.basename( $_FILES['productimage']['name']);   
$file_name= $_FILES['productimage']['name']; 
//echo $target_path;  die('-----');
  
if(move_uploaded_file($_FILES['productimage']['tmp_name'], $target_path)) {    

   $arr1= array("spPostingPic"=>$file_name); 
//$FeatureImg= 1;
   //$pf->createPic($res, $file_name, $FeatureImg);  
    $pf->updatePic_pos($arr1,$id); 
}
} else{
	$arr1= array("spPostingPic"=>$hidden_file);  

    $pf->updatePic_pos($arr1,$id); 
}
/*
if($_FILES['uploadidentity1']){  
$target_path = "upload_pos/"; 
$target_path = $target_path.basename( $_FILES['uploadidentity1']['name']);
  $file_name= $_FILES['uploadidentity1']['name']; 
  
if(move_uploaded_file($_FILES['uploadidentity1']['tmp_name'], $target_path)) {  
      $arr1= array("file2"=>$file_name); 

    $p->update($arr1,$id); 
} 
} else{  
	
	$arr1= array("file2"=>$file_2); 

    $p->update($arr1,$id); 
}
*/

$_SESSION['msg'] = 2;

?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/product-list.php?key=all'; ?>";  

</script>
