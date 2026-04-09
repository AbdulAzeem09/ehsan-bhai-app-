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
 
	   $rss=$_GET['rssid'];
	   $obj=new _spprofiles;
	    $obj->channelremove($rss); 
	 $accepted=$_GET['accepted'];
	 $pending=$_GET['pending'];
	 $rejected=$_GET['rejected'];
	if($accepted){
	?>
	<script>
    window.location ='<?php echo $BaseUrl;?>/news/mychannels.php?tab=accepted';
</script>

	<?php 
	}  
	 if($pending){  
    ?>
    <script>
    window.location ='<?php echo $BaseUrl;?>/news/mychannels.php?tab=pending';
</script>
	 <?php }
	 if($rejected){  
	 ?>  
	 <script>
    window.location ='<?php echo $BaseUrl;?>/news/mychannels.php?tab=rejected';
</script>
	 <?php } ?>