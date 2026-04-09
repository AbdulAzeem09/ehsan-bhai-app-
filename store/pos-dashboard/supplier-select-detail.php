<?php 



 include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 
	
	//print_r($_POST); die("----------");    
	
	$p = new _pos;  

$prodid = $_POST['prodid']; 
$type = $_POST['type']; 
$supplier_id = $_POST['id']; 

if($type == "product"){

$result_1 = $p->read_id_invt_receive_detail($prodid);  



if ($result_1) {
$row_1 = mysqli_fetch_assoc($result_1);

$products_in = $row_1['products_in']; 
$data['product_name'] ='<input type="text" class="form-control me-2" name="products_in" id="select_product_id" placeholder="" value="'.$products_in.'" aria-label="" aria-describedby="addon-wrapping" required >';     

} else {

$data['product_name'] = "";   

}

echo json_encode($data);  

} else {


$result_1 = $p->read_supplier_id($supplier_id);  

if ($result_1) {
$row_1 = mysqli_fetch_assoc($result_1);

$email = $row_1['email']; 
$phone = $row_1['phone']; 

}

$data['vendorid'] = '<input type="text" class="form-control mb-3 mt-3 me-2" required name="vender_id_in" id="vender_id_in_" value="'.$supplier_id.'" style="width: 100px;" placeholder="Vendor ID" aria-label="vendorID" aria-describedby="addon-wrapping">';  

$data['email'] = '<input type="text" class="form-control mb-3 mt-3 me-2" required name="email_in" id="email_in_id" placeholder="Email" value="'.$email.'" aria-label="Email" style="width: 290px;" aria-describedby="addon-wrapping"> ';  

$data['phone'] = '<input type="number" class="form-control mb-3 mt-3" required name="phone_in" id="phone_in_id" placeholder="Phone" value="'.$phone.'" aria-label="phone" aria-describedby="addon-wrapping">';  

echo json_encode($data);          
}
?>

