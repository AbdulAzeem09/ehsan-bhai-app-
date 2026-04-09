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
 
 $tbl = $_POST['tbl'];
 
 
 if($tbl == "membership_qty"){


 $res = $p->read_data_membership_qty($_SESSION['uid']);

if($res){
	
	$data ='<select class="form-control form-select shadowBox" id="submembership" name="submembership[]" multiple>
	
	<option selected> Select Sub Membership</option>';
	
	while($row = mysqli_fetch_assoc($res)){
	$name_qty = $row['name_qty'];
	$barcode = $row['barcode'];
 	
	$data .='<option value="'.$barcode.'">'.$name_qty.'</option>';
	  
	 
	 

}
$data .='</select>';

}
echo $data; 
}


if($tbl == "membership_dur"){


 $res = $p->read_data_membership_dur($_SESSION['uid']);

if($res){
	
	$data ='<select class="form-control form-select shadowBox" id="submembership" name="submembership[]" multiple>
	<option selected> Select Sub Membership</option>';
	while($row = mysqli_fetch_assoc($res)){ 
	$name_qty = $row['Name'];
	$barcode= $row['barcode'];
 	
	$data .='<option value="'.$barcode.'">'.$name_qty.'</option>';
	  
	 
	 

}
$data .='</select>';

}
echo $data; 
}
 
?>

