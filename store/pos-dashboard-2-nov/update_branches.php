<?php 
include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 


//print_r($_GET); die();
$p = new _pos;  
//$res = $u->read($_SESSION["uid"]);

$pid = $_SESSION['pid'];
$u_id = $_SESSION['uid'];
$id = $_POST['id'];

$branches_name = $_POST['branches_name'];
$branches_address = $_POST['branches_address'];
$branches_contact = $_POST['branches_contact'];





$data = array(
			   "branches_name"=>$branches_name,
			   "branches_address"=>$branches_address,
			   "branches_contact"=>$branches_contact
			   
			   
			   );

$res = $p->update_branches_method($data,$id);      

  
  
?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=branch_type'; ?>";

</script>