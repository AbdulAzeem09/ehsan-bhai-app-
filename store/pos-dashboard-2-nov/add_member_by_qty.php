<?php 
include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 


//print_r($_POST); die();
$p = new _pos;  
$sp = new _spprofiles;  
//$res = $u->read($_SESSION["uid"]);

$pid = $_SESSION['pid'];
$u_id = $_SESSION['uid'];
$name_qty = $_POST['name_qty'];
$Qty_qty = $_POST['Qty_qty'];
$price_qty = $_POST['price_qty'];
$decription_in = $_POST['decription_in'];
$barcode_in = $_POST['barcode_in'];
$Membership = "Membership_quantity";


$data1 = array(
			   "spPostingTitle"=>$name_qty,
			   "retailQuantity"=>$Qty_qty,
			   "spPostingPrice"=>$price_qty,
			   "spPostingNotes"=>$decription_in,
			   "subcategory"=>$Membership,
			   "barcode"=>$barcode_in, 
			   "spCategories_idspCategory"=>1,
			   
			   
			   );

 $res2 = $sp->create_spproduct($data1);   



$data = array("pid"=>$pid,
               "uid"=>$u_id,
			   "name_qty"=>$name_qty,
			   "Qty_qty"=>$Qty_qty,
			   "price_qty"=>$price_qty,
			   "decription_in"=>$decription_in,
			   "barcode"=>$barcode_in,
			   "product_table_id"=>$res2,
			   
			   
			   );

$res = $p->create_mem_qty_method($data);  



  
?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=membership_type'; ?>";

</script>