<?php 
	/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
	    require_once("../../univ/baseurl.php" );
	session_start();
	if(!isset($_SESSION['pid'])){ 
		$_SESSION['afterlogin']="dashboard/";
		include_once ("../../authentication/islogin.php");
		
		}else{
		function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}
		
		spl_autoload_register("sp_autoloader");
		
		//print_r($_POST);
		$id=$_SESSION['uid']; 
		$data=array("spUserEmail"=>$_POST['email']);
		
		$n= new _spuser;
		$n->updateEmail($data,$id);
	//header("location:https://dev.thesharepage.com/dashboard/settings/");
	?>
	<script>
  window.location.replace('<?php echo $BaseUrl?>/dashboard/settings/'); 
  </script>
	<?php
	      

		}?>
		