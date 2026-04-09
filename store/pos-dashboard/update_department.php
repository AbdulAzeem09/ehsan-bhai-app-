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

$department_in = $_POST['department_in'];





$data = array(
			   "department_in"=>$department_in 
			   
			   
			   );

$res = $p->update_department_method($data,$id);     

if($_POST['Department']){
	header("Location: department.php");
}else{
?>
  
?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=dep_type'; ?>";

</script>
<?php } ?>