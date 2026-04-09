<?php



include '../univ/baseurl.php';
session_start();

 
	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	

	?>

	
	<?php
		//session_start();
 
	  $a=$_SESSION['pid'];
	   $b=$_GET['whom'];
	   $data=array(
	   
	   'who'=>$a,
	   'whom'=>$b 
	   
	   );
	   $obj=new _spprofiles; 
	    $obj->removefollow($a,$b);
	 $obj->insert_follow($data);
	 
	 
	
	 
	 	$adds=$_GET['records'];
	?>
	<script>
    window.location ='<?php echo $BaseUrl;?>/news/search.php?records=<?php echo $adds;?>&btns=';
</script>

	<?php 
	    include('../component/f_footer.php');
	    include('../component/f_btm_script.php'); 
    ?>
    <?php
		
	?>