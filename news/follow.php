<?php



include '../univ/baseurl.php';
session_start();

if (!isset($_SESSION['pid'])) {
	$_SESSION['afterlogin'] = "videos/";
	include_once "../authentication/check.php";

} else {
	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	

	?>

	
	<?php
		  
	include_once "../header.php";
	
	  $a=$_POST['who'];
	   $b=$_POST['whom'];
	   $data=array(
	   
	   'who'=>$a,
	   'whom'=>$b,
	   
	   
	   
	   
	   );
	   $obj=new _spprofilefeature;
	 $obj->createfolloers( $data);
	?>
	

	<?php 
	    include('../component/f_footer.php');
	    include('../component/f_btm_script.php'); 
    ?>
    <?php
		}
	?>