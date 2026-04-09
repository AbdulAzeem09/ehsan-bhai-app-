<?php 



 include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 
	
	//print_r($_POST); die("----------");  
	
	$p = new _pos;  

$inventory_in_id = $_POST['inventory_in_id'];


$pid = $_SESSION['pid'];
$u_id = $_SESSION['uid']; 
$Barcode_in = $_POST['Barcode_in'];
$products_in = $_POST['products_in'];
$Color_in = $_POST['Color_in'];
$size_in = $_POST['size_in'];
$qty_in = $_POST['qty_in'];
$cost_in = $_POST['cost_in'];    
$t_cast = $_POST['t_cast'];
$markup_in = $_POST['markup_in'];
$gp_in = $_POST['gp_in'];
$price_in = $_POST['price_in'];

if($price_in == '')
{
$price_in = 0;
}else{
$price_in = $price_in;   
}
//$myfile = $_POST['myfile'];
$gst_in = $_POST['gst_in'];
$supplier_in = $_POST['supplier_in'];
$vender_id_in = $_POST['vender_id_in'];
$email_in = $_POST['email_in'];
$phone_in = $_POST['phone_in'];
$poNo_in = $_POST['poNo_in'];
$invNo_in = $_POST['invNo_in'];
$invDate_in = $_POST['invDate_in'];
$ref_in = $_POST['ref_in'];
$currency = $_POST['currency'];
if($inventory_in_id == ''){ 


$data = array("pid"=>$pid,
               "uid"=>$u_id,
			   
			   "supplier_in"=>$supplier_in,
			   "vender_id_in"=>$vender_id_in,
			   "email_in"=>$email_in,
			   "phone_in"=>$phone_in,
			   "poNo_in"=>$poNo_in,
			   "invNo_in"=>$invNo_in,
			   "invDate_in"=>$invDate_in,   
			   "ref_in"=>$ref_in

); 

$res = $p->add_invt_receive($data); 



$result_1 = $p->read_supplier_id($supplier_in);  

if ($result_1) {
$row_1 = mysqli_fetch_assoc($result_1);

$customer_name = $row_1['customer_name']; 

}


$data['vendor_detail'] = '<div class="col-12 mb-3 addtional_data">
<div class="border-3 border-primary border-top p-1 bg-light shadowBox"> 
<div class="col-12 mb-3 addtional_data">
<div class="mb-1">
<div class="input-group d-flex mobile-view"> 
<div class="col-md-4 col-sm-12 pe-2">
   <span><b>Vendor Name</b> : '.$customer_name.' </span> 
</div>
<div class="col-md-4 col-sm-12 pe-2">
   <span><b>Invoice Number</b> : '.$invNo_in.' </span>
</div>

<div class="col-md-4 col-sm-12 pe-2">
   <span><b>Date</b> : '.$invDate_in.'</span> 
</div>
</div>
</div>
</div>

<div class="col-12 mb-3 addtional_data">
<div class="mb-1">
<div class="input-group d-flex mobile-view"> 
<div class="col-md-4 col-sm-12 pe-2">
   <span><b>Email</b> : '.$email_in.' </span>
</div>
<div class="col-md-3 col-sm-12 pe-2">
   <span><b>PO Number</b> : '.$poNo_in.' </span>
</div>

<div class="col-md-4 col-sm-12 pe-2">
   
</div>
</div>
</div>
</div>


<div class="col-12 mb-3 addtional_data">
<div class="mb-1">
<div class="input-group d-flex mobile-view"> 
<div class="col-md-4 col-sm-12 pe-2">
   <span><b>Phone</b> : '.$phone_in.' </span>
</div>
<div class="col-md-3 col-sm-12 pe-2">
   <span><b>Reference</b> : '.$ref_in.' </span> 
</div>

<div class="col-md-4 col-sm-12 pe-2">
   
</div>
</div>
</div>
</div>
</div>  
</div> ';  

$data['invent_id'] = '<input type="hidden"  name= "inventory_in" id = "inventory_in_id" value="'.$res.'"  > '; 

$data1 = array("pos_receiver_id"=>$res, 
			   "Barcode_in"=>$Barcode_in,
			   "products_in"=>$products_in,
			   "Color_in"=>$Color_in,
			   "size_in"=>$size_in,
			   "qty_in"=>$qty_in,
			   "cost_in"=>$cost_in,
			   "t_cast"=>$t_cast,
			   "markup_in"=>$markup_in,
			   "gp_in"=>$gp_in,
			   "price_in"=>$price_in,
			   "gst_in"=>$gst_in,
			   "currency"=>$currency
			   
			
); 

$res1 = $p->add_invt_receive_detail($data1);  



$data2 = array("spProfiles_idspProfiles"=>$pid,
               "spuser_idspuser"=>$u_id,
	          "pos_receiver_id"=>$res, 
			   "barcode"=>$Barcode_in,
			   "spPostingTitle"=>$products_in,
			   "Color_in"=>$Color_in,
			   "size_in"=>$size_in,
			   "retailQuantity"=>$qty_in,
			   "cost_in"=>$cost_in,
			   "pirce_in"=>$t_cast,
			   "markup_in"=>$markup_in,
			   "gp_in"=>$gp_in,
			   "spPostingPrice"=>$price_in,
			   "gst_in"=>$gst_in,
			   "default_currency"=>$currency 
			   
			
); 

$sp = new _spprofiles;  

$sp->create_spproduct($data2);    


}else{

$data1 = array("pos_receiver_id"=>$inventory_in_id,    
			   "Barcode_in"=>$Barcode_in,
			   "products_in"=>$products_in,
			   "Color_in"=>$Color_in,
			   "size_in"=>$size_in,
			   "qty_in"=>$qty_in,
			   "cost_in"=>$cost_in,
			   "t_cast"=>$t_cast,
			   "markup_in"=>$markup_in,
			   "gp_in"=>$gp_in,
			   "price_in"=>$price_in,
			   "gst_in"=>$gst_in,
			   "currency"=>$currency
			   
			
); 

$res1 = $p->add_invt_receive_detail($data1); 




$data2 = array("spProfiles_idspProfiles"=>$pid,
               "spuser_idspuser"=>$u_id,
	          "pos_receiver_id"=>$inventory_in_id,     
			   "barcode"=>$Barcode_in,
			   "spPostingTitle"=>$products_in,
			   "Color_in"=>$Color_in,
			   "size_in"=>$size_in,
			   "retailQuantity"=>$qty_in,
			   "cost_in"=>$cost_in,
			   "pirce_in"=>$t_cast,
			   "markup_in"=>$markup_in,
			   "gp_in"=>$gp_in,
			   "spPostingPrice"=>$price_in,
			   "gst_in"=>$gst_in,
			   "default_currency"=>$currency 
			   
			
); 

$sp = new _spprofiles;  

$sp->create_spproduct($data2);    




}

$data['app_data'] = '<tr id="app'.$res1.'"><td>'.$Barcode_in.'</td>    
<td>'.$products_in.'</td> 
<td>'.$Color_in.'</td>
<td>'.$size_in.'</td>
<td id="quanty'.$res1.'" value="'.$qty_in.'">'.$qty_in.'</td> 
<td>'.$currency.' '.$cost_in.'</td>
<td>'.$currency.' '.$t_cast.' </td> 
<td>'.$markup_in.'</td>
<td>'.$gp_in.'</td>
<td id="price'.$res1.'" value="'.$price_in.'" >'.$currency.' '.$price_in.'</td>    
<td> <a  onclick="deleterow('.$res1.','.$qty_in.','.$price_in.','.$t_cast.')" class="text-danger"> <i class="fas fa-trash"></i></a> </td><tr>';     

echo json_encode($data);          

?>

