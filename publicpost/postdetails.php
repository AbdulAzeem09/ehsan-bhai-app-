<?php
	session_start();
	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _postingview;
	$result = $p->read($_POST['idspPostings']);
	if($result != false)
	{
		$row = mysqli_fetch_assoc($result);
		echo "<input type='hidden' id='postititle' value='".$row["spPostingtitle"]."' name='posttitle'>";
		
		//echo "<input type='hidden' id='shareprofile' value='".$row["spProfileName"]."' name='profilename'>";
		
		echo "<input type='hidden' id='sharedpost' value='".$_POST['idspPostings']."' name='postid'>";
	}
?>