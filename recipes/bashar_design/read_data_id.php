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
 $member_ship_ = $_POST['member_ship_'];
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

$data = array("membership_limit"=>$member_ship_,  
               "customer_id"=>$customer_id,
			   "membership_left"=>$member_ship_ 
			   
			  
); 

 $p->create_member_1($data);   

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

