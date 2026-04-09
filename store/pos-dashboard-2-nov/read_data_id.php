<?php 
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

//die('========');
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
 
 if($tbl == "spuser"){

$res = $p->read_data_phone($phone); 

//print_r($res);  die();
if($res){
	$row = mysqli_fetch_assoc($res);
	
 	 $data['customer_name'] = $row['spUserName']; 
  	  $data['email'] = $row['spUserEmail'];  
  	  $data['id'] = $row['idspUser'];  
	  
	  //$arr = array("phone"=>$phone,"email"=>$email); 
	 echo json_encode($data); 

  }}
  
  $p = new _pos;  
 $id = $_POST['id'];
 $tbl = $_POST['tbl'];
 
 
  if($tbl == "pos_membership_barcode"){

  $res = $p->read_data_phone1($id); 

//print_r($res);  die('======');
if($res){
	 $data['quantity']=0;

	//$row = mysqli_fetch_assoc($res); 
	while ($row = mysqli_fetch_assoc($res)){

//$data['id'] = $row['id'];

 $data['quantity'] =  $data['quantity']+$row['quantity'];



}
	  
	  //$arr = array("phone"=>$phone,"email"=>$email); 
	 echo json_encode($data); 

  }
  else{
	 $data = ['quantity' =>''];
	   
	 echo json_encode($data); 
  }

  }
  
  
  
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
	
 	 $data['id'] = $row_1['barcode'];      
 	 $data['title'] = $row_1['spPostingTitle'];  
 	 $data['price'] = $row_1['spPostingPrice'];  
 	 $data['category'] = $row_1['subcategory'];   
 	 $retailQuantity = $row_1['retailQuantity']; 

    if($retailQuantity == 0){
		
	$data['quantity'] =	'<input type="text" class="form-control me-1" placeholder="Out Of stock" readonly aria-label="Quantity" aria-describedby="addon-wrapping" id=""> ';
	}else{
		
		$data['quantity'] = '<input type="text" class="form-control me-1" placeholder="Quantity" aria-label="Quantity" aria-describedby="addon-wrapping" id="quantity_"> ';
	}
	 
	
	 
 	 $idspPostings  = $row_1['idspPostings']; 
	 
	 $pv = new _spproductoptionsvalues;  
     $res_2 = $pv->read_by_temp_id($idspPostings);  
	 $res_3 = $pv->read_by_temp_id($idspPostings);  
	 
	 
	 //print_r($res_2); die('------------');
	 
	
	 if($res_2){
		  $data['size'] .='<select class="form-control" name="size" id="size_" >';
		 while ($row_2 = mysqli_fetch_assoc($res_2)){
			 //print_r($row_2); 
			 $size_idsopv = $row_2['size_idsopv']-11; 
			 $idspa  = $row_2['idspa ']; 
			 
			 $data['size'] .= '<option value="'.$size_idsopv.'">'.$size_idsopv.'</option>';
			 //$color_id =  $row_2['color_idsopv'];
			 
			 //$valuedata = $pv->singleread($color_idsopv);
		 }
		 $data['size']  .= '</select>';
		 
		 
	 } else{
		 $data['size'] = '<input type="text" class="form-control" placeholder="Size" readonly aria-label="Size" aria-describedby="addon-wrapping" id="size_">';
	 }
	 
	  if($res_3){
		   $data['color'] .='<select class="form-control" name="color" id="color_">'; 
		 while ($row_3 = mysqli_fetch_assoc($res_3)){
                $color_id =  $row_3['color_idsopv'];
              $valuedata = $pv->singleread($color_id); 
			 
			  if($valuedata){
		      while ($row_4 = mysqli_fetch_assoc($valuedata)){
		        $da_color = $row_4['opton_values']; 
		        $idsopv = $row_4['idsopv']; 
				
                $data['color'] .= '<option value="'.$da_color.'">'.$da_color.'</option>';   				
			  }
			   
			  }
         }	
        $data['color']  .= '</select>'; 		 
	  } else{
		 $data['color'] = '<input type="text" class="form-control" placeholder="Color" readonly aria-label="Color" aria-describedby="addon-wrapping" id="color_">';  
	  }
		
	 echo json_encode($data);       
	
  }
  
  
  }










?>

