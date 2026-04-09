<?php 
include('../../univ/baseurl.php');
    session_start();
	$_SESSION['msga']= 3;
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 


//print_r($_GET); die();
$p = new _pos;  
//$res = $u->read($_SESSION["uid"]);


$action = $_GET['action']; 
$row_id = $_GET['id'];

if($action == "delete"){
	 $p->remove_tax_method($row_id);   
	  
  }
if($action == "addTax"){
	$p->remove_tax_method($row_id);   
	header("Location: settingsto.php?record=tax_typee");

}else{  
  
?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=tax_type'; ?>";

</script>
<?php } ?>