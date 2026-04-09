<?php 
include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 

	$_SESSION['msg']= 3;

//print_r($_GET); die();
$p = new _pos;  
//$res = $u->read($_SESSION["uid"]);


$action = $_GET['action']; 
$row_id = $_GET['id'];

if($action == "delete"){
	 $p->remove_department_method($row_id);    
	  
  }else{
	$p->remove_department_method($row_id);
  }
  if($action == "deleteDep"){
	header("Location: department.php");
  } else{

  
?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=dep_type'; ?>";

</script>
<?php } ?>