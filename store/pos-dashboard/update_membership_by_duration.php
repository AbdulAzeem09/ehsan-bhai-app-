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
$Name = $_POST['Name'];
$dur_Qty = $_POST['dur_Qty'];
$paymentterm = $_POST['paymentterm'];
$dur_price = $_POST['dur_price'];
$description_in = $_POST['description_in'];
$barcode_in = $_POST['barcode_in'];



$data = array(
			  "Name"=>$Name,
			   "dur_Qty"=>$dur_Qty,
			   "paymentterm"=>$paymentterm,
			   "dur_price"=>$dur_price,
			   "description_in"=>$description_in,
			   "barcode"=>$barcode_in,
			   );

$res = $p->update_mem_dur_method($data,$id);  


$result_1 = $p->read_data_membership_qty_dur_id($id);
if ($result_1) {
 
 $row_1 = mysqli_fetch_assoc($result_1);   
 
  $product_table_id = $row_1['product_table_id'];
  
  
  $data1 = array(
			   "spPostingTitle"=>$Name,
			   "retailQuantity"=>$dur_Qty,
			   "spPostingPrice"=>$dur_price,
			   "spPostingNotes"=>$description_in,
			  "barcode"=>$barcode_in,
			   );
			   
			    $sp->update_mem_qty_product($data1,$product_table_id);   
  
 }   

  
  
?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=membership_type'; ?>"; 

</script>