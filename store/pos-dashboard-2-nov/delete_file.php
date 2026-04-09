<?php 

/*Array ( [p_id] => 2971 [u_id] => 385 [fullname] => MOHIT SINGH [address] => VILL-NAGLA SHARKI NEAR HOLI CHOWK DIST- BUDAUN [spUserEmail] => price@gmail.com [zipcode] => 243601 [phone] => 7052303666 [uploadidentity] => s-2.jpg [uploadidentity1] => s-3.jpg ) ----------*/
error_reporting(E_ALL);
ini_set('display_errors', 1);

 include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 
	
	
	
	$p = new _pos;  
//$res = $u->read($_SESSION["uid"]);

$id = $_POST['id'];
$type = $_POST['type'];

//print_r($_POST); die();

if($_POST['type']=="first_img"){

$file_1 = "NULL";
$arr1= array("file1"=>$file_1); 

    $p->update($arr1,$id);  
}


if($_POST['type']=="second_img"){

$file_1 = "NULL";
$arr2= array("file1"=>$file_1); 

    $p->update($arr2,$id); 
}
?>