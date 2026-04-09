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
//$email = $_POST['email'];
//$customer_id = $_POST['customer_id'];
$pay_rand_no = $_POST['pay_rand_no'];

$result=$p->read_pos_customer_rand_no($pay_rand_no); 
                                    if ($result != false) {
											$row = mysqli_fetch_assoc($result); 
							                $status =	$row['status'];
											echo  $status ;
										
									}
	 















?>

