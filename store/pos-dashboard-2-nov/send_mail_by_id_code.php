<?php 


//error_reporting(E_ALL);
//ini_set('display_errors', 1);

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
$email = $_POST['email'];
$customer_id = $_POST['customer_id'];
$pay_rand_no = $_POST['pay_rand_no'];


$code = rand(11111,99999);

$_SESSION['code_opt'] = $code; 

$res = $p->cust_name($customer_id); 

//print_r($res);  die();
if($res){
	$row = mysqli_fetch_assoc($res);
	
 	 $datacustomer_name = $row['customer_name'];  
  	  
	  
	 

  }


$e = new _email;   




$re = $e->send_mail_onid_email_code($datacustomer_name, $email, $code);     













?>

