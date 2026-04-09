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
    //print_r($_FILES);
	//print_r($_POST); die();
	
	$p = new _pos;  
//$res = $u->read($_SESSION["uid"]);

//$customer_id = $_SESSION['customer_id'];
//$u_id = $_SESSION['uid'];
//$email = $_POST['email'];
//$customer_id = $_POST['customer_id'];
$pay_rand_no = $_POST['pay_rand_no'];


	 $seen_seller = 1;
	 
	 $data = array("seen_seller" => $seen_seller );
	   
	
	 $us2=$p->update_pos_customer_rand_no($data,$pay_rand_no);     


   
$res1=$p->read_pos_customer_rand_no($pay_rand_no); 




if($res1 != false){
	$row_1 = mysqli_fetch_assoc($res1);
	
	$id = $row_1['id'];
	
	$res2=$p->read_pos_customer_id($id); 
	
	
	
	if($res2 != false){
		while($row_2 = mysqli_fetch_assoc($res2)){
			
			$barcode = $row_2['barcode'];
			$quantity = $row_2['quantity'];
			$size = $row_2['size'];
			$size_idsopv = $size+11;
			
			$sp = new _spprofiles;  
     $res3 = $sp->readprice_barcode($barcode); 
	 if($res3 != false){
	 $row3 = mysqli_fetch_assoc($res3);
	 
	        $idspPostings = $row3['idspPostings'];
			$retailQuantity = $row3['retailQuantity'];
			$quantity_new = ($retailQuantity - $quantity);
			
			 $data1 = array('retailQuantity'=>$quantity_new);
		   
		   $up1 = $sp->update_mem_qty_product($data1,$idspPostings);
			
	 
	 
	 }
	 $spv = new _spproductoptionsvalues;  
     $res4 = $spv->read_by_temp_id_size($idspPostings,$size_idsopv); 
	 
	 if($res4 != false){
		  $row4 = mysqli_fetch_assoc($res4);
		  
		   $opt_qty = $row4['opt_qty'];
		   
		   $quantity_new_1 = ($opt_qty - $quantity); 
		   
		   $data = array('opt_qty'=>$quantity_new_1);
		   
		   $up = $spv->update_by_temp_id_size($data,$idspPostings,$size_idsopv);   
		 
	 }
	 
	 
	 
	 
			
		}
		
		
	}

}	













?>

