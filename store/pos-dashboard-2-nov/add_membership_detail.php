<?php 


/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/

 include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 
	
	
	
	$p = new _pos;  
//$res = $u->read($_SESSION["uid"]);

$pid = $_POST['pid'];
$uid = $_POST['uid'];
$membership_name = $_POST['fullname'];
$membership_duration = $_POST['quantity'];
$membership_status = $_POST['status'];
$membership_price = $_POST['price'];


$data = array("spuser_idspuser"=>$uid,
               "spprofiles_idspprofiles"=>$pid,
			   "membership_name"=>$membership_name,
			   "membership_duration"=>$membership_duration,
			   "membership_status"=>$membership_status,
			   "membership_price"=>$membership_price
			  
			
); 

$res = $p->create_membership($data); 


header("Location:$BaseUrl/store/pos_dashboard1/Membership.php");


?>

<script>
//window.location.href = "<?php echo $BaseUrl.'/store/pos_dashboard1/index.php'; ?>";

</script>