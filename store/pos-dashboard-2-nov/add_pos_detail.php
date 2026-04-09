<?php 


error_reporting(E_ALL);
ini_set('display_errors', 1);

 include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 
	//echo "<pre>";    
//print_r($_POST); die('=======');    



	
	$p = new _pos;  
//$res = $u->read($_SESSION["uid"]);

$pid = $_SESSION['pid'];
$u_id = $_SESSION['uid'];
$customer_id = $_POST['customer_id'];
$barcode = $_POST['barcode'];
$product_name = $_POST['product_name'];
$color = $_POST['color'];
$size = $_POST['size'];
$quantity = $_POST['quantity'];    
$unit_price = $_POST['unit_price'];    
$discount = $_POST['discount'];    
$total_price = $_POST['total_price'];    
$membership_id = $_POST['membership_id']; 
$currency = $_POST['currency']; 
$customerr_user_id=$_POST['customerr_user_id'];

if($membership_id == "Membership_quantity" || $membership_id == "Membership_duration" ) {
	$sp = new _spprofiles;  
$res_1 = $sp->readprice_barcode($barcode); 
	$row_1 = mysqli_fetch_assoc($res_1);
	$quanty_member = $row_1['retailQuantity'];

$data2 = array("pid"=>$pid,  
               "uid"=>$u_id,
			   "customer_id"=>$customer_id,    
			   "barcode"=>$barcode,
			   "quantity"=>$quanty_member,  	
			   "currency"=>$currency,
			   "customerr_user_id"=>$customerr_user_id,
			   "type"=>$membership_id
			   );   	
			   
		$res1 = $p->create_mem_bar($data2); 	



$res_1 = $sp->readprice_barcode_quanity($barcode); 

$res_2 = $sp->readprice_barcode_duration($barcode);


		
	
	$type = 1;
}  else{
	$type = 2; 
}





//$result_1 = $p->read_pos_customer_id($customer_id);
//if ($result_1) {
 
 //$row_1 = mysqli_fetch_assoc($result_1);     
 
  //$id = $row_1['id'];
  
  $data = array("pid"=>$pid,  
               "uid"=>$u_id,
			   "customer_id"=>$customer_id,    
			   "barcode"=>$barcode,
			   "product_name"=>$product_name,
			   "color"=>$color,
			   "size"=>$size,
			   "quantity"=>$quantity,
			   "unit_price"=>$unit_price,
			   "discount"=>$discount,
			   "total_price"=>$total_price, 
			   "type"=>$type,  
			  
			  
); 

$res = $p->add_pos_record($data); 
  
			   

  
//}   











?>

