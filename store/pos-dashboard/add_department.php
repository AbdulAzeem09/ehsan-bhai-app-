<?php 
include('../../univ/baseurl.php');
    session_start();
function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader"); 

	$_SESSION['msg']= 1;
//print_r($_POST); die();
$p = new _pos;  
//$res = $u->read($_SESSION["uid"]);

$pid = $_SESSION['pid'];
$u_id = $_SESSION['uid'];
$department_in = $_POST['department_in'];
$data = array("pid"=>$pid,
               "uid"=>$u_id,
			   "department_in"=>$department_in,
			   'pos_empid' => $_SESSION['pos_emplyee_id']
			   );

$res = $p->create_department($data);  
if($_POST['Department']){
	header("Location: department.php");
}else{
?>
<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/settings.php?record=dep_type'; ?>";

</script>
<?php } ?>