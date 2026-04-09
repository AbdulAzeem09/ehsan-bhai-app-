<?php 
include('../../univ/baseurl.php');
    session_start();

	$_SESSION['msg']= 2;

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

$tax_type = $_POST['tax_type'];
$tax_value = $_POST['tax_value'];





$data = array(
			   "tax_type"=>$tax_type,
			   "tax_value"=>$tax_value 
			   
			   
			   );

$res = $p->update_tax_method($data,$id);     
$action = $_GET['action'];
if($action == "addTax"){
	header("Location: settingsto.php?record=tax_typee");

}else{

?> 

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=tax_type'; ?>";

</script>
<?php } ?>