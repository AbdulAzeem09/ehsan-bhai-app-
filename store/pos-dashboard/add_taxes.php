<?php 
include('../../univ/baseurl.php');
    session_start();

	$_SESSION['msg']= 1;


	
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 


//print_r($_POST); die();
$p = new _pos;  
//$res = $u->read($_SESSION["uid"]);
$action = $_GET['action'];
$pid = $_SESSION['pid'];
$u_id = $_SESSION['uid'];
$tax_type = $_POST['tax_type'];
$tax_value = $_POST['tax_value'];


$data = array("pid"=>$pid,
               "uid"=>$u_id,
			   "tax_type"=>$tax_type,
			   "tax_value"=>$tax_value
			   
			   
			   );

$res = $p->create_taxes($data);  


if($action == "addTax"){
	header("Location: settingsto.php?record=tax_typee");

}else{
?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=tax_type'; ?>";

</script>
<?php } ?>