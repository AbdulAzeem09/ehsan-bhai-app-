<?php 
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/


 include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 
	
	
	
	$p = new _pos;  
 $id = $_POST['id'];
 $phone = $_POST['phone'];
 $barcode_id = $_POST['barcode_id'];
 $tbl = $_POST['tbl'];
 $member_ship_1 = $_POST['member_ship_'];
 $customer_id = $_POST['customer_id'];
 
 if($tbl == "customer"){

$res = $p->read_data_phone($phone); 

//print_r($res);  die();
if($res){
	$row = mysqli_fetch_assoc($res);
	
 	 $data['customer_name'] = $row['customer_name']; 
  	  $data['email'] = $row['email'];  
  	  $data['id'] = $row['id'];  
	  
	  //$arr = array("phone"=>$phone,"email"=>$email); 
	 echo json_encode($data); 

  }}
  
  
  
  if($tbl == "membership"){

$res1 = $p->read_mem_bar($_SESSION['uid'],$_SESSION['pid']);
//print_r('$res1');

if($res1 == True){
	echo 1;
$row_2 = mysqli_fetch_assoc($res1);
$id = $row_2['id'];
$quanty_member = $row_2['quantity']; 

$member_ship = $quanty_member - $member_ship_1; 


$data1 = array("quantity"=>$member_ship); 
              
			   
			  


 $p->update_mem_bar($data1,$id);   
}else{ echo 2; ?>
	
	

 <?php }


}
  
  
   if($tbl == "product"){
$sp = new _spprofiles;  
$res_1 = $sp->readprice_barcode($barcode_id); 

//print_r($res_1); die(); 
if($res_1){
	$row_1 = mysqli_fetch_assoc($res_1); 
	
 	
     $data['products'] = $row_1['spPostingTitle'];       
 	// $data['current_location'] = $row_1['current_location'];  
 	// $data['Location'] = $row_1['Location'];  
 	// $data['qty'] = $row_1['qty'];    
	 
	
	 echo json_encode($data);       
	
  }
  
  
  }










?>

