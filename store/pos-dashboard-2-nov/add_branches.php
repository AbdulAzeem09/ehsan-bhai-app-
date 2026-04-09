<?php 
include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 


//print_r($_POST); die();
$p = new _pos;  
//$res = $u->read($_SESSION["uid"]);

$pid = $_SESSION['pid'];
$u_id = $_SESSION['uid'];
$branches_name = $_POST['branches_name'];
$branches_address = $_POST['branches_address'];
$branches_contact = $_POST['branches_contact'];


$data = array("pid"=>$pid,
               "uid"=>$u_id,
			   "branches_name"=>$branches_name,
			   "branches_address"=>$branches_address,
			   "branches_contact"=>$branches_contact
			   
			   
			   );

$res = $p->create_branches($data);  



?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=branch_type'; ?>";

</script>