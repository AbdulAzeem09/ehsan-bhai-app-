<?php 


//error_reporting(E_ALL);
//ini_set('display_errors', 1);

 include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 
	//echo "<pre>";  
   // print_r($_FILES);
	//print_r($_POST); die();   
	
	$p = new _spprofiles;  
//$res = $u->read($_SESSION["uid"]);

$pid = $_SESSION['pid'];
$u_id = $_SESSION['uid'];
$itemNo_in = $_POST['itemNo_in'];
$date_in = $_POST['date_in'];
$gst_in = $_POST['gst_in'];
$pst_in = $_POST['pst_in'];
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
$markup_in = $_POST['markup_in'];
$sellingPrice_in = $_POST['sellingPrice_in'];
$grossprofit_in = $_POST['grossprofit_in']; 
$discountable_in = $_POST['discountable_in']; 
$funcationQty_in = $_POST['funcationQty_in']; 
$pirce_in = $_POST['pirce_in'];
$vendor_in = $_POST['vendor_in'];
$name_in = $_POST['name_in'];
$cost_in = $_POST['cost_in'];
$minReorder_in = $_POST['minReorder_in'];
$lastReceiveCost_in = $_POST['lastReceiveCost_in'];
$lastReceiveDate_in = $_POST['lastReceiveDate_in'];
$barcode_in = $_POST['barcode_in'];
$notes_in = $_POST['notes_in'];
$currency = $_POST['currency'];
$selltype = "Retail";
$spPostingVisibility = "-1";

/*$e = new _email;  

$password = random_int(100000, 999999);


$re = $e->pos_password_email($customer_name, $spUserEmail, $password); 

$en_password = md5($password);*/

$data = array("spProfiles_idspProfiles"=>$pid,
               "spuser_idspuser"=>$u_id,
			   "spPostingTitle"=>$productname_in,
			   "spPostingNotes"=>$notes_in,
			   "barcode"=>$barcode_in,
			   "spPostingDate"=>$date_in,
			   "spPostingExpDt"=>$lastReceiveDate_in,
			   "spPostingPrice"=>$purchase_cost_in,
			   "retailDiscount"=>$discountable_in,
			   "Status"=>$status_in,
			   "sellType"=>$selltype,
			   "minorderqty"=>$minReorder_in,
			   "product_type"=>$product_type_in,
			   "itemNo_in"=>$itemNo_in,
			   "gst_in"=>$gst_in,
			   "pst_in"=>$pst_in,
			   "attributes_in"=>$attributes_in,
			   "atValue_in"=>$atValue_in,
			   "subcategory"=>$product_cat_in,
			   "product_sub_cat_in"=>$product_sub_cat_in,
			   "s_description_in"=>$s_description_in,
			   "l_description_in"=>$l_description_in,
			   "markup_in"=>$markup_in,
			   "sellingPrice_in"=>$sellingPrice_in,
			   "grossprofit_in"=>$grossprofit_in,
			   "funcationQty_in"=>$funcationQty_in,
			   "pirce_in"=>$pirce_in,
			   "vendor_in"=>$vendor_in,
			   "name_in"=>$name_in,
			   "cost_in"=>$cost_in,
			   "default_currency"=>$currency, 
			   "lastReceiveCost_in"=>$lastReceiveCost_in,
			   "spPostingVisibility"=>$spPostingVisibility, 
			
); 

$res = $p->create_spproduct($data);   


$pf = new _productpic;
$target_path = "upload_pos/";  
 
$target_path = $target_path.basename( $_FILES['productimage']['name']);    
$file_name= $_FILES['productimage']['name'];   
//echo $target_path;  die('-----');
  
if(move_uploaded_file($_FILES['productimage']['tmp_name'], $target_path)) {   

   //$arr1= array("file1"=>$file_name); 
$FeatureImg= 1;
   $pf->createPic($res, $file_name, $FeatureImg);   
}



$_SESSION['msg'] = 1;	









?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/product-list.php'; ?>"; 

</script>