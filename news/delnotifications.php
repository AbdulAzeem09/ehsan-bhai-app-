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
 
	 
	   $b=$_GET['id'];
	 
	   $obj=new _spprofiles;
	   $obj->delnotification($b);
	 
	 
	 
	
	  
	?>
	<script>
    window.location ='<?php echo $BaseUrl;?>/news/notification.php';
</script>

	<?php 
	    include('../component/f_footer.php');
	    include('../component/f_btm_script.php'); 
    ?>
    <?php
		
	?>