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

	$whom  = $_GET['whom'];
	$who = $_SESSION['pid'];
	
	$current_id = $_GET['current_id'];
	
	$data = array("whom"=>$whom,"who"=>$who);
	
	
	
	$fl = new _followmusic;
	 $obj=new _spprofiles;
	$dt = $fl->readFoloww($whom, $who);
	if($dt){
	
	   $obj->removefollow($who,$whom);
	}
	else{
	$obj->insert_follow($data);
		}
	
	?>
	
	<script>
	window.location.href = "https://dev.thesharepage.com/news/follower.php?id=<?php  echo  $current_id ; ?>";
	</script>
	
	<?php
	    include('../component/f_footer.php');
	    include('../component/f_btm_script.php'); 
    ?>
    <?php
		}
	?>