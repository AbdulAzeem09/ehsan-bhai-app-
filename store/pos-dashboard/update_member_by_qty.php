<?php 
include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 


//print_r($_GET); die();
$p = new _pos;  
$sp = new _spprofiles;  
//$res = $u->read($_SESSION["uid"]);

$pid = $_SESSION['pid'];
$u_id = $_SESSION['uid'];
$id = $_POST['id'];
$name_qty = $_POST['name_qty'];
$Qty_qty = $_POST['Qty_qty'];
$price_qty = $_POST['price_qty'];
$decription_in = $_POST['decription_in'];
$barcode_in = $_POST['barcode_in'];




$data = array(
			   "name_qty"=>$name_qty,
			   "Qty_qty"=>$Qty_qty,
			   "price_qty"=>$price_qty,
			   "decription_in"=>$decription_in,
			   "barcode"=>$barcode_in,
			   
			   );

$res = $p->update_mem_qty_method($data,$id); 

 $result_1 = $p->read_data_membership_qty_id($id);
if ($result_1) {
 
 $row_1 = mysqli_fetch_assoc($result_1);   
 
  $product_table_id = $row_1['product_table_id'];
  
  
  $data1 = array(
			   "spPostingTitle"=>$name_qty,
			   "retailQuantity"=>$Qty_qty,
			   "spPostingPrice"=>$price_qty,
			   "spPostingNotes"=>$decription_in,
			   "barcode"=>$barcode_in,
			  
			   );
			   
			    $sp->update_mem_qty_product($data1,$product_table_id);  
  
 }
  
  
?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=membership_type'; ?>"; 

</script>