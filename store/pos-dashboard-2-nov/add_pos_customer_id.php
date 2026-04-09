<?php 



 include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 
	 



	
	$p = new _pos;  


$pid = $_SESSION['pid'];
$u_id = $_SESSION['uid'];
$customer_id = $_POST['customer_id'];
$sub_total = $_POST['sub_total'];    
$discount_by_net = $_POST['discount_by_net'];    
$total_by_net = $_POST['total_by_net'];    
$total_tax = $_POST['total_tax'];    
$Gross_net = $_POST['Gross_net'];  
$payment_amount = $_POST['payment_amount'];  
$type_payment = $_POST['type_payment'];  
$pay_rand_no = $_POST['pay_rand_no'];  
$peyment_type = $_POST['peyment_type'];  
$currency = $_POST['currency'];  
$phone_number=$_POST['phone_number'];

if(isset($_SESSION['pos_userid'])){

   $salesperson_id = $_SESSION['pos_userid'];
	$billier_type = 1;

}else{  
	
	 $salesperson_id = $_SESSION['uid'];
	$billier_type = 2;
}


$data_1 = array( "pid"=>$pid,  
                 "uid"=>$u_id,
			     "customer_id"=>$customer_id,
				  "sub_total"=>$sub_total,
			      "discount_by_net"=>$discount_by_net,
			     "total_by_net"=>$total_by_net,
			     "total_tax"=>$total_tax,
			     "Gross_net"=>$Gross_net,  
			     "payment_amount"=>$payment_amount,  
			     "type_payment"=>$type_payment,  
			     "rand_no"=>$pay_rand_no,  
			     "type_payment"=>$peyment_type,  
			     "currency"=>$currency,  
			     "salesperson_id"=>$salesperson_id,     
			     "billier_type"=>$billier_type,  
				 "phone_number"=>$phone_number,
				 
				 );  

$res1 = $p->add_pos_customer($data_1);  

echo $res1;  











?>

