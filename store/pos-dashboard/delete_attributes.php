<?php 
include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 

	$_SESSION['msg']= 3;
//print_r($_GET); die();
$p = new _spproductoptionsvalues;  
//$res = $u->read($_SESSION["uid"]);


$action = $_GET['action']; 
$row_id = $_GET['id'];

if($action == "delete"){
	 $p->delopvalue($row_id);    
	  
  }



  
  
?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/attributes.php'; ?>";

</script>