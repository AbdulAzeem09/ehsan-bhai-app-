<?php 

/*Array ( [p_id] => 2971 [u_id] => 385 [fullname] => MOHIT SINGH [address] => VILL-NAGLA SHARKI NEAR HOLI CHOWK DIST- BUDAUN [spUserEmail] => price@gmail.com [zipcode] => 243601 [phone] => 7052303666 [uploadidentity] => s-2.jpg [uploadidentity1] => s-3.jpg ) ----------*/
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

 include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 
	//echo "<pre>";
//print_r($_POST); die('=============');	
	
	$p = new _pos_po;   
	  
//$res = $u->read($_SESSION["uid"]);

$id = $_POST['id'];
$pid = $_POST['p_id'];
$u_id = $_POST['u_id'];
$iteam = $_POST['iteam'];
$ship = $_POST['ship'];
$on_hand = $_POST['on_hand'];
$quantity = $_POST['quantity'];
$quantity_sold = $_POST['quantity_sold'];
$quantity_record = $_POST['quantity_record'];    
$unit_cost = $_POST['unit_cost'];
$total_cost = $_POST['total_cost'];
$mi = $_POST['mi'];
$notes = $_POST['notes'];
$GST = $_POST['GST'];
$Description = $_POST['Description'];

$data = array(
			  "iteam"=>$iteam,
			   "ship"=>$ship,
			   "on_hand"=>$on_hand,
			   "quantity"=>$quantity,
			   "quantity_sold"=>$quantity_sold,
			   "quantity_record"=>$quantity_record,
			   "unit_cost"=>$unit_cost,
			   "total_cost"=>$total_cost,
			   "mi"=>$mi,
			   "notes"=>$notes,
			   "GST"=>$GST,
			   "Description"=>$Description
			
); 

$res = $p->update_new($data,$id);   





?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/po.php'; ?>";

</script>